<?php
    include("functions.php");
    index();
    
    if (!isset($_SESSION))
    session_start();
    include(HEADER_TEMPLATE);
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Veículos</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa fa-plus"></i> Novo Veículo</a>
            <a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
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
                        <h2>Gerenciamento de <b>Veículos</b></h2>
                    </div>
                    <div class="col-sm-6 text-end"> 
                        <form action="index.php" method="post">
                            <div class="input-group">
                                <input type="text" maxlength="50" class="form-control" name="carros" placeholder="Pesquisar..." required>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-search"></i> Consultar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Tabela -->
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="20%">Modelo</th>
                        <th>Marca</th>
                        <th>Ano</th>
                        <th>Data de Cadastro</th>
                        <th>Foto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($cars) : ?>
                        <?php foreach ($cars as $car) : ?>
                            <tr>
                                <td><?php echo $car['id']; ?></td>
                                <td><?php echo $car['modelo']; ?></td>
                                <td><?php echo $car['marca']; ?></td>
                                <td><?php echo $car['ano']; ?></td>
                                <td><?php echo formatadata($car['created'], "d/m/Y"); ?></td>
                                <td>
                                    <?php
                                         if (empty($car['foto'])) {
                                            $imagem = 'SemImagem.png';
                                        } else {
                                            $imagem = $car['foto'];
                                        }
                                        echo "<img src=\"../imagens/".$imagem."\"" . " alt='Foto do veículo' class='img-fluid img-thumbnail border rounded' style='max-width: 150px'>";       
                                    ?>
                                </td>
                                <td>
                                    <a href="view.php?id=<?php echo $car['id']; ?>" class="view" title="Visualizar" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                    <a href="edit.php?id=<?php echo $car['id']; ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                    <a href="#" class="delete" title="Excluir" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $car['id']; ?>"><i class="material-icons">&#xE872;</i></a>
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

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>
