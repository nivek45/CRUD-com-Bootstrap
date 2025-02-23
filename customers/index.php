
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
        <h2>Clientes</h2>
        </div>
        <div class="col-sm-6 text-right h2">
        <a class="btn btn-secondary" href="add.php"><i class="fa fa-user-plus"></i> Novo Cliente</a>
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
                <div class="row">
                    <div class="col-sm-6"><h2>Gerenciamento de <b>Clientes</b></h2></div>
                    <div class="col-sm-6 text-end"> 
                        <form action="index.php" method="post">
                            <div class="input-group">
                                <input type="text" maxlength="50" class="form-control" name="custo" placeholder="Pesquisar..." required>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-search"></i> Consultar
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Mensagem de alerta -->
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <!-- Tabela -->
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="30%">Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>Atualizado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($customers) : ?>
                        <?php foreach ($customers as $customer) : ?>
                            <tr>
                                <td><?php echo $customer['id']; ?></td>
                                <td><?php echo $customer['name']; ?></td>
                                <td><?php echo formatacpf ($customer['cpf_cnpj']); ?></td>
                                <td><?php echo telefone($customer['phone']); ?></td>
                                <td><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
                                <td>
                                    <a href="view.php?id=<?php echo $customer['id']; ?>" class="view" title="Visualizar" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                    <a href="edit.php?id=<?php echo $customer['id']; ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                    <a href="#" class="delete" title="Excluir" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>"><i class="material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>