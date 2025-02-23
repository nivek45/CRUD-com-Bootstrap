<?php 
    include("functions.php"); 
    view($_GET['id']);
    
    if (!isset($_SESSION))
    session_start();
    include(HEADER_TEMPLATE);
?>

<h2 class="mt-2">Cadastro de Veiculo Nº <?php echo $car['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
        <?php echo $_SESSION['message']; ?>
    </div>
<?php endif; ?>

<dl class="text-center">
    <dt>Modelo do Carro:</dt>
    <dd><?php echo $car['modelo']; ?></dd>

    <dt>Marca do Carro:</dt>
    <dd><?php echo $car['marca']; ?></dd>

    <dt>Data de Lançamento:</dt>
    <dd><?php echo $car['ano']; ?></dd>

    <dt>Data de Cadastro:</dt>
    <dd><?php echo formatadata($car['created'], "d/m/Y - H:i:s"); ?></dd>

    <dt>Data da última atualização:</dt>
    <dd><?php echo formatadata($car['modified'], "d/m/Y - H:i:s"); ?></dd>
</dl>

<dl class="text-center">
    <?php
        if (empty($car['foto'])) {
            $imagem = 'SemImagem.png';
        } else {
            $imagem = $car['foto'];
        }
    ?>
    <div class="text-right mb-3">
        <img src='../imagens/<?php echo $imagem; ?>' class='img-fluid img-thumbnail border rounded' style='max-width: 100px;' alt='Imagem do Carro'>
    </div>
    <dt>Foto do Carro</dt>
</dl>

<div id="actions" class="text-center">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $car['id']; ?>" class="btn btn-secondary">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
