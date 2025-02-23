<?php 
  if (!isset($_SESSION))
  session_start();

  include('functions.php'); 
  edit();

  include(HEADER_TEMPLATE);
?>


<?php include(HEADER_TEMPLATE); ?>
    <style>
      form {
        background-color: #fff;
        padding: 10px;
        margin: 0 auto;
        max-width: 900px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }


     
      #actions .btn {
      margin-right: 10px;
      }

     
      .form-group {
      margin-bottom: 10px;
      }

      label {
      font-weight: bold;
      }

      input.form-control {
      border-radius: 4px;
      padding: 10px;
      }

     
      .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      }

     
      .btn-default {
      background-color: #f8f9fa;
      border-color: #ccc;
      color: black;
      padding: 10px 20px;
      border-radius: 5px;
      }

    </style>
    <br>
    <br>

    <form action="edit.php?id=<?php echo $car['id']; ?>" method="post" enctype="multipart/form-data">
    <h2>Atualizar o Carro</h2>
    <hr />
    <div class="row">
    <div class="form-group col-md-6">
      <label for="modelo">Modelo</label>
      <input type="text" class="form-control" name="car['modelo']"  value="<?php echo $car['modelo']; ?>" maxlength="50" placeholder="Digite o modelo"  pattern="[0-1-A-Za-z\s]+">
    </div>

    <div class="form-group col-md-4">
      <label for="marca">Marca</label>
      <input type="text" class="form-control" name="car['marca']" value="<?php echo $car['marca']; ?>" maxlength="30" placeholder="Digite a marca" required  pattern="[A-Za-z\s]+">
    </div>

    <div class="form-group col-md-2">
      <label for="ano">Ano</label>
      <input type="number" class="form-control" name="car['ano']" value="<?php echo $car['ano']; ?>" min="1886" max="2024" placeholder="Digite o ano de fabricação" required  pattern="\d{8}">
      </div>
    </div>

    <div class="form-group">
        <label for="foto">Foto do Carro</label>
            <?php
            if (empty($car['foto'])) {
                $imagem = 'SemImagem.png';
            } else {
                $imagem = $car['foto'];
            }
            ?>
            <div class="text-right mb-3">
                <img src='../imagens/<?php echo $imagem; ?>' class='img-fluid img-thumbnail border rounded' style='max-width: 100px;' alt='Imagem do Filme'>
            </div>
        <input type="file" name="foto" id="foto" class="form-control">
    </div>

    
    <div class="form-group col-md-2">
      <label for="created">Data de Cadastro</label>
      <input type="text" class="form-control" name="car['created']" disabled value="<?php echo $car['created']; ?>">
    </div>
  </div>

  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
    </div>
  </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>