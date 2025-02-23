
<?php
    include("functions.php");
    index();
	
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
 
<header class="mt-5">
    <div class="row">
        <div class="col-sm-6">
            <h2>Usuários</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-gear"></i> Novo Usuário</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php clear_messages()?>
    <?php endif; ?>         
<hr>  
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row align-items-center"> 
                    <!-- #loira #viral #reflexaomotivacionaltoguro -->
                    <div class="col-sm-6">
                        <h2>Gerenciamento de <b>Usuários</b></h2>
                    </div>
                    <div class="col-sm-6 text-end"> 
                        <form action="index.php" method="post">
                            <div class="input-group">
                                <input type="text" maxlength="50" class="form-control" name="users" placeholder="Pesquisar..." required>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-search"></i> Consultar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>User</th>
                        <th>Data de Cadastro</th>
                        <th>Foto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($usuarios) : ?>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['id']; ?></td>
                                <td><?php echo $usuario['nome']; ?></td>
                                <td><?php echo $usuario['user']; ?></td>
                                <td><?php echo formatadata($usuario['created'], "d/m/Y"); ?></td>
                                <td>
                                    <?php
                                        if (empty($usuario['foto'])) {
                                            $foto = 'SemImagem.png';
                                        } else {
                                            $foto = $usuario['foto'];
                                        }
                                        echo "<img src=\"fotos/".$foto."\"" . " alt='Foto do usuário' class='img-fluid img-thumbnail border rounded' style='max-width: 150px'>"; 
                                    ?>
                                </td>
                                <td>
                                    <a href="view.php?id=<?php echo $usuario['id']; ?>" class="view" title="Visualizar" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                    <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                    <a href="#" class="delete" title="Excluir" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $usuario['id']; ?>"><i class="material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>