<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>CRUD com Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/meucss/style.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/meucss/style2.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/meucss/responsive.css">
    <link rel="shortcut icon" type="image/icon" href="<?php echo BASEURL; ?>assets/logo/carro.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        .navbar {
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: transparent;
            border-bottom: transparent;
        }
        .dropdown-menu {
            min-width: 200px;
            font-size: 20px;
            background-color: #ffffff;
        }
        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=UTF8,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 width%3D%2230%22 height%3D%2230%22 viewBox%3D%220 0 30 30%22%3E%3Cpath stroke%3D%22rgba%28255, 255, 255, 0.5%29%22 stroke-width%3D%222%22 d%3D%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E');
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-header a.navbar-brand {
            color: white;
            font-size: 24px;
            letter-spacing: 30px;
            font-family: 'Rufina', serif;
            font-weight: 700;
            padding: 45px 0px;
            text-transform: uppercase;
        }
        .navbar-header a.navbar-brand:hover {
            color: #4e4ffa;
            transition: color 0.3s ease;
        }
        .navbar-nav > li > a {
            color: gray;
            transition: 0.3s linear;
            display: flex;
            align-items: center;
            font-size: 20px;
            font-family: inherit;
            font-weight: normal;
        }
        .navbar-nav > li > a:hover {
            color: white;
        }

        .dropdown-item {
            color: inherit !important;
            background-color: transparent !important;
            font-size: inherit !important;
        }
        .dropdown-item:hover,
        .dropdown-item:focus,
        .dropdown-item:active {
            background-color: transparent !important;
            color: inherit !important;
            font-size: inherit !important; 
            transform: none !important; 
            padding: inherit !important; 
            box-shadow: none !important; 
        }
        .navbar-nav .nav-item img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 10px;
        }
        .user-button {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }
        .user-button:hover {
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="top-area">
        <div class="header-area">
            <nav class="navbar navbar-expand-lg bg-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php" style="color: gray;">
                        <i class="fa fa-home" style="margin-right: 5px; margin-left: 70px;"></i>CRUD
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- Dropdown Clientes -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="clientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-users" style="margin-right: 5px;"></i> Clientes
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="clientesDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar Clientes</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a></li>
                                </ul>
                            </li>
                            <!-- Dropdown Carros -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="carrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-car" style="margin-right: 5px;"></i> Carros
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="carrosDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>meutema"><i class="fa-solid fa-car-rear"></i> Carros</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>meutema/add.php"><i class="fa-solid fa-car-rear"></i><i style="font-size: 10px" class="fa-solid fa-plus"></i> Cadastrar Carros</a></li>
                                </ul>
                            </li>
                            <!-- Opções extras para o administrador -->
                            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin"): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="carrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user" style="margin-right: 5px;"></i> Usuários
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="carrosDropdown">
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>user/add.php"><i class="fa-solid fa-user-plus"></i> Adicionar Usuário</a></li>
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>user/index.php"><i class="fa-solid fa-users-cog"></i> Gerenciar Usuários</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <?php if (isset($_SESSION['user'])) : ?>
                            <?php
                                if (isset($_SESSION['foto']) && !empty($_SESSION['foto'])) {
                                    $foto = $_SESSION['foto'];
                                } else {
                                    $foto = 'sem-foto.png';
                                }
                            ?>
                            <div class="d-flex align-items-center">
                                <a href="<?php echo BASEURL; ?>inc/valida.php" class="me-2 text-light text-decoration-none"><?php echo $_SESSION['user'] ; ?></a>
                                <img src="<?php echo BASEURL . 'user/fotos/' . $foto; ?>" style="width: 40px; height: 40px; border-radius: 50%;">
                            </div>
                        </a>
                    <?php else: ?>
                        <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                            <i class="fa-solid fa-users"></i> Login
                        </a>
                    <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>