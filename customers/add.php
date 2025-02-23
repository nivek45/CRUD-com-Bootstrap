<?php 
  require_once('functions.php'); 
  add();

  if (!isset($_SESSION))
  session_start();

  if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: ../inc/login.php");
    exit();
}

  include(HEADER_TEMPLATE);
?>
<style>
    form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    max-width: 1100px;
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

  input[name="customer['created']"] {
    min-width: 140px;
    width: 100%;
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
</style>
<br><br>
<form action="add.php" method="post">
<h2>Novo Cliente</h2>
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="customer['name']" maxlength = "50"  pattern="[A-Za-z\s]+" placeholder="Digite o nome" title="Apenas letras são permitidas." required>
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">CNPJ / CPF</label>
      <input type="text" class="form-control" name="customer['cpf_cnpj']" maxlength = "11" pattern="\d{11,11}" title="Apenas números são permitidos e o comprimento deve ser no máximo 11 caracteres." placeholder="Digite o número do CNPJ/CPF" required>
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="customer['birthdate']" required>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="customer['address']" maxlength = "50"  pattern="[A-Za-z\s]+" placeholder="Digite o Endereço" title="Apenas letras são permitidas." required>
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Bairro</label>
      <input type="text" class="form-control" name="customer['hood']" maxlength = "50"  pattern="[A-Za-z\s]+" placeholder="Digite o Bairro" title="Apenas letras são permitidas." required>
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">CEP</label>
      <input type="text" class="form-control" name="customer['zip_code']" pattern="\d{8}" maxlength = "8" title="Apenas números são permitidos e o comprimento deve ser de 8 caracteres sem caracteres especiais" placeholder="Digite o número do CEP">
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="text" class="form-control" name="customer['created']" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo1">Município</label>
      <input type="text" class="form-control" name="customer['city']" maxlength = "20"  pattern="[A-Za-z\s]+" placeholder="Digite o Múnicipio" title="Apenas letras são permitidas." >
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo2">Telefone</label>
      <input type="text" class="form-control" name="customer['phone']" pattern="\d{11}" maxlength = "11" title="Apenas números são permitidos e o comprimento deve ser de 11 caracteres sem espaço e pontuação" placeholder="Digite o Telefone" required>
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="customer['mobile']" pattern="\d{11}" maxlength = "11" title="Apenas números são permitidos e o comprimento deve ser de 11 caracteres sem espaço e pontuação" placeholder="Digite o Celular" required>
    </div>
    
    <div class="form-group col-md-1">
      <label for="campo3">UF</label>
      <input type="text" class="form-control" name="customer['state']" maxlength = "2"   pattern="[A-Z]{2}" placeholder="Sigla" title="Apenas Duas letras Maiúsculas são permitidas." required>
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">Inscrição Estadual</label>
      <input type="text" class="form-control" name="customer['ie']" pattern="\d{10}" maxlength = "10">
    </div>
  
    <div id="actions" class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
      </div>
  </div>
</form>
<?php include(FOOTER_TEMPLATE); ?>