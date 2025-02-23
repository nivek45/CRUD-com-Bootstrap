<?php
	include("../config.php");
	include(DBAPI);
    
    

    $cars = null;
    $car = null;

    function index() {
        global $cars;
        if (!empty($_POST['carros'])) {
            $cars = filter("cars", $_POST['carros']);
        } else {
            $cars = find_all("cars");
        }
    }
    

    function view($id = null) {
        global $car;
        $car = find('cars', $id);
    }

    function edit() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['user'])) {
            echo "<script>
                    alert('Você precisa estar logado para realizar esta ação.');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        }
        $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            if (isset($_POST['car'])) {
                $car = $_POST['car'];
                $car['modified'] = $now->format("Y-m-d H:i:s");
    
                $uploadDir = '../imagens/';
                
                
                $currentCar = find('cars', $id);
                $oldImage = $currentCar['foto'] ?? '';
    
                if (!empty($_FILES['foto']['name'])) {
                    $imageName = basename($_FILES['foto']['name']);
                    $uploadFile = $uploadDir . $imageName;
    
                    
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                        $car['foto'] = $imageName;
    
                        
                        if (!empty($oldImage) && file_exists($uploadDir . $oldImage)) {
                            unlink($uploadDir . $oldImage);
                        }
                    } else {
                        echo "Erro ao enviar o arquivo.";
                        return;
                    }
                } else {
                    
                    $car['foto'] = $oldImage;
                }
    
                update('cars', $id, $car);
                header('location: index.php');
            } else {
                global $car;
                $car = find('cars', $id);
            }
        } else {
            header('location: index.php');
        }
    }
    
    

    function add() {
        if (!empty($_POST['car'])) {
            $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
            $car = $_POST['car'];
            $car['created'] = $now->format("Y-m-d H:i:s");
            $car['modified'] = $now->format("Y-m-d H:i:s");
    
            $uploadDir = dirname(__DIR__) . '/imagens/';
    
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $imageName = basename($_FILES['foto']['name']);
                $imagePath = $uploadDir . $imageName;
    
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath)) {
                    $car['foto'] = $imageName;
                } else {
                    $_SESSION['message'] = "Erro ao carregar a imagem.";
                    $_SESSION['type'] = 'danger';
                    return;
                }
            }

            save('cars', $car);
            header('location: index.php');
            exit();
        }
    }

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

    function filter($table = null, $condition = null) {
        $database = open_database();
        $found = null;
    
        try {
            if ($table && $condition) {
                // Construção da consulta com parâmetro
                $sql = "SELECT * FROM $table WHERE modelo LIKE ?";
                $stmt = $database->prepare($sql);
    
                if ($stmt) {
                    $param = '%' . $condition . '%'; // Adiciona os curingas para o LIKE
                    $stmt->bind_param("s", $param); // "s" indica string no bind_param
                    
                    $stmt->execute();
                    $result = $stmt->get_result();
    
                    if ($result->num_rows > 0) {
                        $found = $result->fetch_all(MYSQLI_ASSOC);
                    }
    
                    $stmt->close();
                }
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    
        close_database($database);
        return $found;
    }
    
?>
