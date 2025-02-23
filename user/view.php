
<?php 
    include("functions.php"); 
    view($_GET['id']); 
    
    if (!isset($_SESSION))
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
        echo "<script>
                if (confirm('Acesso restrito a administradores! Clice no Cancelar para voltar para o índice')) {
                    window.location.href = 'index.php';
                } else {
                    window.history.back();
                }
              </script>";
        exit(); 
    }

    include(HEADER_TEMPLATE);
?>

<h2 class="mt-2">Cadastro de Usuário Nº <?php echo htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8'); ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
        <?php echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<dl class="text-center">
    <dt>Nome:</dt>
    <dd><?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?></dd>

    <dt>Username:</dt>
    <dd><?php echo htmlspecialchars($usuario['user'], ENT_QUOTES, 'UTF-8'); ?></dd>

    <dt>Senha:</dt>
    <dd><?php echo htmlspecialchars($usuario['password'], ENT_QUOTES, 'UTF-8'); ?></dd>

    <dt>Data de Cadastro:</dt>
    <dd><?php echo htmlspecialchars(formatadata($usuario['created'], "d/m/Y - H:i:s"), ENT_QUOTES, 'UTF-8'); ?></dd>

    <dt>Última Atualização:</dt>
    <dd><?php echo htmlspecialchars(formatadata($usuario['modified'], "d/m/Y - H:i:s"), ENT_QUOTES, 'UTF-8'); ?></dd>
</dl>

<dl class="text-center">
    <?php
        if (empty($usuario['foto'])) {
            $foto = 'SemImagem.png';
        } else {
            $foto = $usuario['foto'];
        }
    ?>
    <div class="text-right mb-3">
        <img src='fotos/<?php echo htmlspecialchars($foto, ENT_QUOTES, 'UTF-8'); ?>' 
             class='img-fluid img-thumbnail border rounded' 
             style='max-width: 100px;' 
             alt='Foto do Usuário'>
    </div>
    <dt>Foto do Usuário</dt>
</dl>

<div id="actions" class="text-center">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
