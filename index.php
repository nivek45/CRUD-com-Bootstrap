<?php 
    include "config.php";
    include DBAPI; 
    $db = open_database(); 

    if (!isset($_SESSION))
    session_start();
    include(HEADER_TEMPLATE);
?>
<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* Adiciona um fundo escuro nos ícones */
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

    div[class*=box] {
        height: 33.33%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn {
        line-height: 50px;
        height: 50px;
        text-align: center;
        width: 250px;
        cursor: pointer;
        margin: 5px;
    }

    /* Botão estilo "btn-one" */
    .btn-one {
        color: #fff;
        transition: all 0.3s;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 250px;
        height: 60px;
        background-color: gray;
        border-radius: 10px;
        text-decoration: none;
        text-align: center;
        font-weight: bold;
        overflow: hidden;
        height: 100px; /* Aumentado de 60px */
        line-height: 100px; /* Ajuste proporcional */

    }
    .btn-one span {
        z-index: 2;
        transition: all 0.3s;
    }
    .btn-one::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: 0;
        transition: all 0.3s;
        border-top: 1px solid rgba(255, 255, 255, 0.5);
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        transform: scale(0.1, 1);
    }
    .btn-one:hover span {
        letter-spacing: 2px;
    }
    .btn-one:hover::before {
        opacity: 1;
        transform: scale(1, 1);
    }
    .btn-one::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        transition: all 0.3s;
        background-color: rgba(255, 255, 255, 0.1);
    }
    .btn-one:hover::after {
        opacity: 0;
        transform: scale(0.1, 1);
    }

    /* Ajuste de layout responsivo */
    .model-search-content {
        padding: 60px 0; /* Adicionado padding vertical para mais espaço */
        background-color: #fff; /* Garantir o fundo branco */
        border-radius: 10px; /* Para um acabamento suave */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Opcional: um leve sombreado */
    }

    .admin-buttons {
        margin-top: 20px; /* Espaçamento entre os botões normais e os de admin */
        width: 100%; /* Garante que ocupa toda a largura */
        display: flex;
        flex-wrap: wrap; /* Permite organizar em múltiplas linhas, se necessário */
        justify-content: center; /* Centraliza os botões */
    }

    /* Estilo dos Cards */
    #featured-cars .card {
    transition: all 0.3s ease-in-out;
    border-radius: 16px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
    }

    #featured-cars .card-img-top {
    height: 150px; /* Ajusta a altura da imagem */
    width: 100%;  /* Largura total */
    object-fit: contain; /* Garante que a imagem será ajustada dentro do espaço sem ser cortada */
    transition: transform 0.3s ease-in-out;
    }

    #featured-cars .card-body {
    padding: 1.25rem;
    }

    #featured-cars .card-title {
    font-size: 1.2rem;
    margin-bottom: 15px;
    }

    #featured-cars .text-primary {
        font-size: 1.3rem;
        font-weight: 600;
        color: gainsboro; /* Cor escura para combinar com o site */
    }

    #featured-cars .card-text {
        font-size: 0.9rem;
        color: #777;
    }

    /* Efeito de Hover nos Cards */
    #featured-cars .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    #featured-cars .card:hover .card-img-top {
        transform: scale(1.05);
    }

    /* Estilo para a lista de detalhes */
    #featured-cars .card ul {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        justify-content: space-evenly;
        font-size: 0.8rem;
    }

    /* Título "Featured Cars" */
    #featured-cars h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        text-align: center;
        position: relative;
        margin-bottom: 40px;
    }
    #featured-cars h2::after {
        content: "";
        display: block;
        height: 3px;
        width: 70px;
        background-color: gray; /* Linha azul abaixo do título */
        margin: 20px auto 0;
    }

    #new-cars h2
    {
        font-size: 2rem;
        font-weight: 700;
        position: relative;
    }

    #new-cars h2::after {
        content: "";
        display: block;
        height: 3px;
        width: 70px;
        background-color: gray; /* Linha azul abaixo do título */
        margin: 20px auto 0;
    }

    .text-primary
    {
        color: gray;
    }

    .brand img {
    transition: transform 0.3s ease;
    }

    .brand img:hover {
    transform: scale(1.1); /* Aumenta levemente a imagem ao passar o mouse */
    }
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInAnimation 1.5s ease-out forwards;
    }

    @keyframes fadeInAnimation {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .btn-one {
            width: 100%; /* Botões em largura total em telas pequenas */
        }
    }
</style>
<section id="home" class="welcome-hero">
    <div class="container">
      <div class="welcome-hero-txt text-center fade-in">
            <h2>Consiga seu carro dos sonhos</h2>
            <p>Melhores carros e a maior exclusividade de todo o mercado</p>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="model-search-content d-flex flex-wrap justify-content-center align-items-center" style="max-width: 1300px;">
                    <!-- Botão Novo Cliente -->
                    <div class="col-6 col-sm-4 col-md-2 mb-4">
                        <a href="customers/add.php" class="btn btn-one">
                            <i class="fa fa-user-plus fa-3x"></i>
                            <span>Novo Cliente</span>
                        </a>
                    </div>
                    <!-- Botão Clientes -->
                    <div class="col-6 col-sm-4 col-md-2 mb-4">
                        <a href="customers" class="btn btn-one">
                            <i class="fa fa-users fa-3x"></i>
                            <span>Clientes</span>
                        </a>
                    </div>
                    <!-- Botão Carros -->
                    <div class="col-6 col-sm-4 col-md-2 mb-4">
                        <a href="cars" class="btn btn-one">
                            <i class="fa fa-car fa-3x"></i>
                            <span>Carros</span>
                        </a>
                    </div>
                    <!-- Botão Gerenciar Carros -->
                    <div class="col-6 col-sm-4 col-md-2 mb-4">
                        <a href="manage_cars" class="btn btn-one">
                            <i class="fa fa-car fa-3x"></i><i style="font-size: 10px;" class="fa fa-plus"></i>
                            <span>Gerenciar Carros</span>
                        </a>
                    </div>
                    <!-- Botões visíveis somente para admin -->
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin"): ?> 
                        <div class="admin-buttons">
                            <div class="col-6 col-sm-4 col-md-2 mb-4">
                                <a href="<?php echo BASEURL; ?>user/add.php" class="btn btn-one">
                                    <span>
                                        <i class="fa-solid fa-user-tie fa-3x"></i>
                                        Novo Usuário
                                    </span>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2 mb-4">
                                <a href="<?php echo BASEURL; ?>user/index.php" class="btn btn-one">
                                    <span>
                                        <i class="fa-solid fa-user-lock fa-3x"></i>
                                        Usuários
                                    </span>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br><br><br><br><br><br><br><br>

<section id="new-cars" class="new-cars py-5">
    <br><br><br>
    <div class="container">
        <div class="text-center mb-4">
            <h2>Melhores Carros</h2>
        </div>
        <div id="newCarsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Item 1 -->
                <div class="carousel-item active">
                    <div class="single-new-cars-item">
                        <div class="row g-0">
                            <div class="col-md-7 col-sm-12">
                                <div class="new-cars-img">
                                    <img src="assets/images/new-cars-model/ncm1.png" alt="Imagem do carro Chevrolet Camaro" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="new-cars-txt">
                                    <h2><a href="#">Chevrolet Camaro <span>ZA100</span></a></h>
                                    <p>O Chevrolet Camaro ZA100 é um ícone entre os esportivos, conhecido por seu design agressivo e desempenho impressionante.</p>
                                    <p class="new-cars-para2">Com linhas aerodinâmicas e uma frente robusta, o Camaro transmite uma presença marcante na estrada.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="carousel-item">
                    <div class="single-new-cars-item">
                        <div class="row g-0">
                            <div class="col-md-7 col-sm-12">
                                <div class="new-cars-img">
                                    <img src="assets/images/new-cars-model/ncm2.png" alt="Imagem do carro BMW Series-3 Wagon" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="new-cars-txt">
                                    <h2><a href="#">BMW Series-3 Wagon</a></h>
                                    <p>A BMW Série 3 Wagon é uma combinação perfeita de estilo, praticidade e desempenho.</p>
                                    <p class="new-cars-para2">Com um design elegante e esportivo, ideal para quem busca se destacar na cidade e na estrada.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="carousel-item">
                    <div class="single-new-cars-item">
                        <div class="row g-0">
                            <div class="col-md-7 col-sm-12">
                                <div class="new-cars-img">
                                    <img src="assets/images/new-cars-model/ncm3.png" alt="Imagem do carro Ferrari 488 Superfast" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="new-cars-txt">
                                    <h2><a href="#">Ferrari 488 Superfast</a></h>
                                    <p>A Ferrari 488 Superfast é uma obra-prima da engenharia, projetada para desempenho extraordinário e design impressionante.</p>
                                    <p class="new-cars-para2">Esse supercarro é um ícone para entusiastas da velocidade.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#newCarsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newCarsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <br><br><br><br><br>
</section>
<section id="featured-cars" class="py-5">
  <div class="container">
    <h2 class="text-center mb-5">Carros em Destaque</h2>
    <div class="row">
      <!-- Car 1 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc1.png" class="card-img-top p-3" alt="BMW 6-Series Gran Coupe">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">BMW 6-Series Gran Coupe</h5>
            <p class="text-primary fw-bold fs-5">R$ 890.395,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 2 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc2.png" class="card-img-top p-3" alt="Chevrolet Camaro WMV20">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">Chevrolet Camaro WMV20</h5>
            <p class="text-primary fw-bold fs-5">R$ 66.575,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 3 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc3.png" class="card-img-top p-3" alt="Lamborghini V520">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">Lamborghini V520</h5>
            <p class="text-primary fw-bold fs-5">R$ 1.125,250</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 4 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc4.png" class="card-img-top p-3" alt="Audi A3 Sedan">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">Audi A3 Sedan</h5>
            <p class="text-primary fw-bold fs-5">R$ 950.500,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 5 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc5.png" class="card-img-top p-3" alt="Infiniti Z5">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">Infiniti Z5</h5>
            <p class="text-primary fw-bold fs-5">R$ 360.850,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 6 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc6.png" class="card-img-top p-3" alt="Porsche 718 Cayman">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">Porsche 718 Cayman</h5>
            <p class="text-primary fw-bold fs-5">R$ 480.500,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 7 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc7.png" class="card-img-top p-3" alt="BMW 8-Series Coupe">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">BMW 8-Series Coupe</h5>
            <p class="text-primary fw-bold fs-5">R$ 560.000,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>

      <!-- Car 8 -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 rounded-4 shadow-sm hover-shadow">
          <img src="assets/images/featured-cars/fc8.png" class="card-img-top p-3" alt="BMW Xseries-6">
          <div class="card-body text-center">
            <ul class="list-unstyled small text-muted mb-2">
              <li>Model: 2017</li>
              <li>3100 Mi</li>
              <li>240HP</li>
              <li>automatic</li>
            </ul>
            <h5 class="card-title fw-bold mb-3">BMW Xseries-6</h5>
            <p class="text-primary fw-bold fs-5">R$ 750,800,00</p>
            <p class="card-text text-muted small">
              Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="brand" class="brand py-5">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-center align-items-center">
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br1.png" alt="Brand 1" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br2.png" alt="Brand 2" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br3.png" alt="Brand 3" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br4.png" alt="Brand 4" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br5.png" alt="Brand 5" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
      <div class="mx-3">
        <a href="">
          <img src="assets/images/brand/br6.png" alt="Brand 6" class="img-fluid" style="max-height: 80px;">
        </a>
      </div>
    </div>
  </div>
</section>

<footer class="container text-center py-4">
    <?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); ?>
    <p>&copy;2024 a <?php echo $data->format("Y") ?> - Kevin e Leandro</p>
</footer>

<script src="js/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/custom.js"></script>

<script>
    const carousel = document.getElementById('newCarsCarousel');
    let startX, endX;

    // Para dispositivos touch
    carousel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    carousel.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    // Para dispositivos com mouse
    carousel.addEventListener('mousedown', (e) => {
        startX = e.clientX;
    });

    carousel.addEventListener('mouseup', (e) => {
        endX = e.clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const sensitivity = 30; // Reduz a distância mínima para 30 pixels
        if (startX - endX > sensitivity) {
            // Swipe para a esquerda
            bootstrap.Carousel.getInstance(carousel).next();
        } else if (endX - startX > sensitivity) {
            // Swipe para a direita
            bootstrap.Carousel.getInstance(carousel).prev();
        }
    }
</script>