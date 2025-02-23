<?php
require_once('functions.php');
add();

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

<style>
  form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    max-width: 600px;
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
</style>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>" role="alert">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message'], $_SESSION['type']); ?>
<?php endif; ?>

<h2 class="mt-2">Novo Usuário</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
  <!-- área de campos do formulário -->
  <hr>
  
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" name="usuario[nome]" maxlength="50" required>
  </div>

  <div class="form-group">
    <label for="user">Usuário</label>
    <input type="text" class="form-control" name="usuario[user]" maxlength="50" required>
  </div>

  <div class="form-group">
    <label for="password">Senha</label>
    <input type="password" class="form-control" name="usuario[password]" maxlength="100" required>
  </div>

  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" class="form-control">
  </div>

  <div class="form-group col-md-4">
      <label for="created">Data de Cadastro</label>
      <input type="text" class="form-control" name="usuario[created]" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
    </div>
  </div>

  <br>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
