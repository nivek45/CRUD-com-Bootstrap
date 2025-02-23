<?php 
    include('functions.php'); 
    edit();

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

    <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
        <h2>Atualizar o Usuário</h2>
        <hr />
        <div class="row">
            <div class="form-group col-md-6">
                <label for="modelo">Nome</label>
                <input type="text" class="form-control" name="usuario['nome']"  value="<?php echo $usuario['nome']; ?>" maxlength="50" placeholder="Digite o nome do user">
            </div>

            <div class="form-group col-md-4">
                <label for="marca">User</label>
                <input type="text" class="form-control" name="usuario['user']" value="<?php echo $usuario['user']; ?>" maxlength="30" placeholder="Digite o nome de usuario" required>
            </div>

            <div class="form-group col-md-4">
                <label for="marca">Senha</label>
                <input type="password" class="form-control" name="usuario[password]" value="" maxlength="30" placeholder="Digite uma nova senha">
                <small class="form-text text-muted">Deixe em branco para manter a senha atual.</small>
            </div>

            <div class="form-group">
                <label for="foto">Foto do Usuário</label>
                    <?php
                    if (empty($usuario['foto'])) {
                        $imagem = 'SemImagem.png';
                    } else {
                        $imagem = $usuario['foto'];
                    }
                    ?>
                    <div class="text-right mb-3">
                        <img src='fotos/<?php echo $imagem; ?>' class='img-fluid img-thumbnail border rounded' style='max-width: 100px;' alt='Imagem do user'>
                    </div>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

        
            <div class="form-group col-md-3">
                <label for="created">Data de Cadastro</label>
                <input type="text" class="form-control" name="usuario[created]" disabled value="<?php echo $usuario['created']; ?>">
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