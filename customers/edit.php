
<?php 
  include('functions.php'); 
  edit();

  if (!isset($_SESSION))
  session_start();
  include(HEADER_TEMPLATE);
?>

<style>
    form {
        background-color: #fff;
        padding: 10px;
        margin: 0 auto;
        max-width: 1150px;
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

<br><br>
<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
    <hr />
    <h2>Atualizar Cliente</h2>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" name="customer['name']" value="<?php echo $customer['name']; ?>" maxlength="50" pattern="[A-Za-z\s]+" placeholder="Digite o nome" title="Apenas letras são permitidas.">
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">CNPJ / CPF</label>
            <input type="text" class="form-control" name="customer['cpf_cnpj']" value="<?php echo $customer['cpf_cnpj']; ?>" maxlength="11" pattern="\d{11,14}" title="Apenas números são permitidos e o comprimento deve ser entre 11 e 14 caracteres." placeholder="Digite o número do CPF/CNPJ">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Nascimento</label>
            <input type="date" class="form-control" name="customer['birthdate']" value="<?php echo $customer['birthdate']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="campo1">Endereço</label>
            <input type="text" class="form-control" name="customer['address']" value="<?php echo $customer['address']; ?>" maxlength="50" pattern="[A-Za-z\s]{0,9}+" placeholder="Digite o Endereço" title="Apenas letras são permitidas.">
        </div>

        <div class="form-group col-md-3">
            <label for="campo2">Bairro</label>
            <input type="text" class="form-control" name="customer['hood']" value="<?php echo $customer['hood']; ?>" maxlength="50" pattern="[A-Za-z\s]+" placeholder="Digite o Bairro" title="Apenas letras são permitidas.">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">CEP</label>
            <input type="text" class="form-control" name="customer['zip_code']" value="<?php echo $customer['zip_code']; ?>" pattern="\d{8}" maxlength="8" title="Apenas números são permitidos e o comprimento deve ser de 8 caracteres.">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Cadastro</label>
            <input type="text" class="form-control" name="customer['created']" disabled value="<?php echo $customer['created']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="campo1">Município</label>
            <input type="text" class="form-control" name="customer['city']" value="<?php echo $customer['city']; ?>" pattern="[A-Za-z\s]+" placeholder="Digite o Município" title="Apenas letras são permitidas.">
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">Telefone</label>
            <input type="text" class="form-control" name="customer['phone']" value="<?php echo $customer['phone']; ?>" pattern="\d{11}" maxlength="11" title="Apenas números são permitidos e o comprimento deve ser no máximo 11 caracteres." placeholder="Digite o Telefone">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Celular</label>
            <input type="text" class="form-control" name="customer['mobile']" value="<?php echo $customer['mobile']; ?>" pattern="\d{11}" maxlength="11" title="Apenas números são permitidos e o comprimento deve ser no máximo 11 caracteres." placeholder="Digite o Celular">
        </div>

        <div class="form-group col-md-1">
            <label for="campo3">UF</label>
            <input type="text" class="form-control" name="customer['state']" value="<?php echo $customer['state']; ?>" maxlength="2" pattern="[A-Z]{2}" placeholder="Sigla" title="Apenas duas letras maiúsculas são permitidas.">
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Inscrição Estadual</label>
            <input type="text" class="form-control" name="customer['ie']" value="<?php echo $customer['ie']; ?>" pattern="\d{10}" maxlength="10" title="Apenas números são permitidos e o comprimento deve ser de 10 caracteres.">
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
