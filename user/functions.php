<?php
require_once('../config.php');
require_once(DBAPI);

if (!isset($_SESSION))
session_start();

$usuarios = null;
$usuario = null;

/**
 * Listagem de Usuários
 */
function index() {
    global $usuarios;
    if (!empty($_POST['users'])) {
        $usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
    } else {
        $usuarios = find_all("usuarios");
    }
}

function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
    // Upload da foto
    try {
        $nomearquivo = basename($arquivo_destino); 
        $uploadOk = 1;
        
        if (isset($_POST["submit"])) {
            $check = getimagesize($nome_temp);
            if ($check !== false) {
                $_SESSION["message"] = "File is an image - " . $check["mime"] . ".";
                $_SESSION["type"] = "info";
            } else {
                throw new Exception("O arquivo não é uma imagem!");
            }
        }

        if (file_exists($arquivo_destino)) {
            throw new Exception("Desculpe, o arquivo já existe!");
        }
        
        if ($tamanho_arquivo > 5000000) {
            throw new Exception("Desculpe, mas o arquivo é muito grande!");
        }
        
        if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
            throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
        }

        if ($uploadOk && move_uploaded_file($_FILES["foto"]["tmp_name"], $arquivo_destino)) {
            $_SESSION["message"] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
            $_SESSION["type"] = "success";
        } else {
            throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
        }
        
    } catch (Exception $e) {
        $_SESSION["message"] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION["type"] = "danger";
    }
}
/**
 * Cadastro de Usuários
 */
function add() {
    if (!empty($_POST['usuario'])) {
        $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        $usuario = $_POST['usuario'];
        $usuario['created'] = $now->format("Y-m-d H:i:s");
        $usuario['modified'] = $now->format("Y-m-d H:i:s");
        
        $uploadDir = "fotos/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        try {
            $bd = open_database(); 
            if (!$bd) {
                throw new Exception("Erro ao conectar ao banco de dados.");
            }

            $stmt = $bd->prepare("SELECT id FROM usuarios WHERE user = ? LIMIT 1");
            if (!$stmt) {
                throw new Exception("Erro ao preparar a consulta: " . $bd->error);
            }

            $stmt->bind_param("s", $usuario['user']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();
                $bd->close();
                throw new Exception("O nome de usuário '{$usuario['user']}' já está em uso. Escolha outro.");
            }

            $stmt->close();

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $imageName = basename($_FILES['foto']['name']);
                $imagePath = $uploadDir . $imageName;
                $tempName = $_FILES['foto']['tmp_name'];
                $fileSize = $_FILES['foto']['size'];
                $fileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                
                upload($uploadDir, $imagePath, $fileType, $tempName, $fileSize);
                $usuario['foto'] = $imageName;
            }

            if (!empty($usuario['password'])) {
                $usuario['password'] = criptografia($usuario['password']);
            }
            
            save('usuarios', $usuario);
            
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}



function filter($table = null, $condition = null) {
    $database = open_database();
    $found = null;

    try {
        if ($table && $condition) {
            // Consulta preparada para evitar SQL Injection
            $sql = "SELECT * FROM $table WHERE $condition";
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

/**
 * Atualizacao/Edicao de Usuários
 */
function edit() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['usuario'])) {
            $usuario = $_POST['usuario'];

            if (empty($usuario['password'])) {
                $usuario_atual = find('usuarios', $id);
                $usuario['password'] = $usuario_atual['password'];
            } else {
                $usuario['password'] = criptografia($usuario['password']);
            }
            
            if (!empty($_FILES["foto"]["name"])) {
                $pasta_destino = "fotos/";
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                $nome_temp = $_FILES["foto"]["tmp_name"];
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
                $tamanho_arquivo = $_FILES["foto"]["size"];

                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                $usuario['foto'] = basename($arquivo_destino);
            }

            update('usuarios', $id, $usuario);
            header('Location: index.php');
        } else {
            global $usuario;
            $usuario = find('usuarios', $id);
        }
    } else {
        header('Location: index.php');
    }
}

/**
 * Visualização de um Usuário
 */
function view($id = null) {
    global $usuario;
    $usuario = find('usuarios', $id);
}

/**
 * Exclusão de um Usuário
 */
function delete($table, $column, $id) {
    try {
        // Localizar o registro antes de excluir
        $usuario = find($table, $id);

        if ($usuario) {
            $uploadDir = 'fotos/';
            $imagePath = $uploadDir . $usuario['foto'];

            // Verificar se a imagem existe e excluí-la
            if (!empty($usuario['foto']) && file_exists($imagePath)) {
                if (!unlink($imagePath)) {
                    $_SESSION['message'] = "Erro ao excluir a imagem: $imagePath.";
                    $_SESSION['type'] = "danger";
                    return;
                }
            }
        }

        // Preparar e executar a exclusão do registro
        $sql = "DELETE FROM $table WHERE $column = :id";
        $stmt = getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registro excluído com sucesso.";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Erro ao excluir o registro no banco de dados.";
            $_SESSION['type'] = "danger";
        }
    } catch (Exception $e) {
        // Capturar qualquer erro e salvar a mensagem
        $_SESSION['message'] = "Erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}
?>
