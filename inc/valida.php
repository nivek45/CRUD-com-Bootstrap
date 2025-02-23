<?php
if (!isset($_SESSION)) session_start();

// Esse é o valida.php
include ('../config.php');
require_once(DBAPI);
include(HEADER_TEMPLATE);

if (isset($_SESSION['user'])) {

    $foto = (!empty($_SESSION['foto']) && file_exists(BASEURL . 'user/fotos/' . $_SESSION['foto'])) ? $_SESSION['foto'] : 'sem-foto.png';
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
    echo "Você já está logado como " . $_SESSION['nome'] . ".";
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    echo '<a href="' . BASEURL . 'inc/logout.php" class="btn btn-danger"><i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar</a>';
} else {
    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header('Location: ' . BASEURL . 'index.php');
        exit;
    }

    $bd = open_database();
    if (!$bd) {
        die("Erro ao conectar ao banco de dados.");
    }

    try {
        $usuario = $_POST['login'];
        $senha = criptografia($_POST['senha']);
        
        if (!empty($usuario) AND !empty($senha)) {
            $stmt = $bd->prepare("SELECT id, nome, user, password, foto FROM usuarios WHERE user = ? AND password = ? LIMIT 1;");
            $stmt->bind_param("ss", $usuario, $senha);
            $stmt->execute();
            $query = $stmt->get_result();
            
            if ($query->num_rows > 0) {
                $dados = $query->fetch_assoc();
                $nome = $dados['nome'];
                $user = $dados['user'];
                $foto = $dados['foto'];
                $password = $dados['password'];
                
                if (!empty($user)) {
                    $_SESSION['id'] = $dados['id'];
                    $_SESSION['nome'] = $nome;
                    $_SESSION['user'] = $user;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['password'] = $password;

                    if (!isset($_SESSION['welcome_shown'])) {
                        $_SESSION['message'] = "Bem-vindo, " . $nome . "!";
                        $_SESSION['type'] = 'info';
                        $_SESSION['welcome_shown'] = true;
                    }
                } else {
                    throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
                }
            } else {
                throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
            }
        } else {
            throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php 
        unset($_SESSION['message']);
        unset($_SESSION['type']);
    endif;

}
?>

<a href="<?php echo BASEURL ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>

<?php include(FOOTER_TEMPLATE); ?>
