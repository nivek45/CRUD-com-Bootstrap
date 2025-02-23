<?php
    // Esse é o login.php
    include('../config.php');
    include(HEADER_TEMPLATE);
?>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <div class="card-body">
            <h4 class="text-center mb-4"><i class="fa-solid fa-user-circle"></i> Login</h4>
            <form action="valida.php" method="post">
                <!-- User input -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="log" placeholder="Usuário" name="login" required>
                    <label for="log"><i class="fa-solid fa-user"></i> Usuário</label>
                </div>

                <!-- Password input -->
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="pass" placeholder="Senha" name="senha" required>
                    <label for="pass"><i class="fa-solid fa-lock"></i> Senha</label>
                </div>

                <!-- Submit and Cancel buttons -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-user-check"></i> Conectar
                    </button>
                    <a href="<?php echo BASEURL; ?>" class="btn btn-outline-secondary btn-block">
                        <i class="fa-solid fa-rotate-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
