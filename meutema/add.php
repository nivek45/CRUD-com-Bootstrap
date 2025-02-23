<?php 
  if (!isset($_SESSION))
  session_start();

  if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: ../inc/login.php");
    exit();
}

  require_once('functions.php'); 
  add();

  include(HEADER_TEMPLATE);

  
?>
<style>
  form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    max-width: 900px;
  }


  .form-group label {
    font-weight: bold;
    color: #333;
  }

  .form-control {
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 14px;
    border-radius: 4px;
    transition: border-color 0.3s ease-in-out;
  }


  .form-control:focus {
    border-color: #0056b3;
    box-shadow: none;
  }


  .btn {
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
    text-transform: uppercase;
    margin-right: 10px;
  }

  .btn-secondary {
    background-color: #0056b3;
    color: white;
    border: none;
  }

  .btn-light {
    background-color: #e0e0e0;
    color: #333;
    border: none;
  }

  .btn:hover {
    opacity: 0.8;
  }


  .table {
    background-color: #fff;
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
  }

  input[name="car['created']"] {
    min-width: 250px;
    width: 100%;
  }

  .table th, .table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
  }

  .table th {
    background-color: #f8f9fa;
    font-weight: bold;
  }

  .table tbody tr:hover {
    background-color: #f1f1f1;
  }


  @media (max-width: 768px) {
    .form-group {
      margin-bottom: 15px;
    }
    
    form {
      padding: 15px;
    }
  }
</style>

<br><br><br>

<form action="add.php" method="post" enctype="multipart/form-data">
  <!-- área de campos do formulário -->
  <h2>Novo Veículo</h2>
  <hr />
  <div class="row">
    <div class="form-group col-md-6">
      <label for="modelo">Modelo</label>
      <input type="text" class="form-control" name="car['modelo']" maxlength="50" placeholder="Digite o modelo" required>
    </div>

    <div class="form-group col-md-4">
      <label for="marca">Marca</label>
      <input type="text" class="form-control" name="car['marca']" maxlength="30" placeholder="Digite a marca" required>
    </div>

    <div class="form-group col-md-2">
      <label for="ano">Ano</label>
      <input type="number" class="form-control" name="car['ano']" min="1886" max="2024" placeholder="Digite o ano de fabricação" required>
      </div>
    </div>

  <div class="form-group">
        <label for="foto">Foto do Veículo</label>
        <input type="file" name="foto" id="foto" class="form-control">
  </div>
    
    <div class="form-group col-md-2">
      <label for="created">Data de Cadastro</label>
      <input type="text" class="form-control" name="car['created']" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
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
