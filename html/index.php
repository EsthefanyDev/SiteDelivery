<!-- <?php
// Conexão com o banco de dados
$conexaoD = mysqli_connect("localhost", "root", "", "prime_delivery");

if ($conexaoD->connect_error) {
    die('Erro na conexão: ' . $conexaoD->connect_error);
}

// Consulta ao banco de dados
$sql = "SELECT * FROM Produtos";
$resultado = $conexaoD->query($sql);

if (!$resultado) {
    die('Erro na consulta: ' . $conexaoD->error);
}
?> -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <title>Bem-Vindo ao Prime Delivery</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        .carousel {
            width: 100%;
            margin: 0 auto;
        }
        .carousel__slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header__container">
            <div class="header__logo">
                <img src="../img/Delivery Logotipo .png" alt="Logotipo Prime Delivery">
            </div>
            <nav class="header__nav">
                <a href="#inicio" class="header__nav-link">Ínicio</a>
                <a href="#cardapio" class="header__nav-link">Cardápio</a>
                <a href="#sobre" class="header__nav-link">Sobre</a>
                <a href="#contato" class="header__nav-link">Contato</a>
            </nav>
            <div class="header__actions">
                <a href="../html/pagina-Login.html" class="header__button">
                    <i class="bx bxs-user"></i>
                    Entrar
                </a>
                <a href="../html/3pagina-Cadastro_Clientes.html" class="header__button user-plus">
                    <i class="bx bxs-user-plus"></i>
                    Cadastre-se
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Banner Carousel -->
        <section class="carousel">
            <div class="carousel__slide">
                <img src="../img/slides/pizza.jpg" alt="Pizza">
            </div>
            <div class="carousel__slide">
                <img src="../img/slides/hambur.jpg" alt="Hambúrguer">
            </div>
            <div class="carousel__slide">
                <img src="../img/slides/pizza2.jpg" alt="Pizza">
            </div>
            <div class="carousel__slide">
                <img src="../img/slides/batataFrita2.jpg" alt="Batata Frita">
            </div>
            <div class="carousel__slide">
                <img src="../img/slides/hambur2.jpg" alt="Hambúrguer">
            </div>
        </section>

        <!-- Combos -->
        <section class="combos">
            <h2 class="combos__title">Nossos Combos</h2>
            <ul class="combos__list">
                <li class="combos__item">
                    <img src="../img/combos/Combo-Familia-300x300.png" alt="Combo Família">
                    <a href="#" class="combos__link">
                        <i class='bx bxs-cart-add'></i><span>R$48,59</span>
                    </a>
                </li>
                <li class="combos__item">
                    <img src="../img/combos/Combo-amigos-300x300.png" alt="Combo Amigos">
                    <a href="#" class="combos__link">
                        <i class='bx bxs-cart-add'></i><span>R$21,00</span>
                    </a>
                </li>
                <li class="combos__item">
                    <img src="../img/combos/Combo-Love-300x300.png" alt="Combo Love">
                    <a href="#" class="combos__link">
                        <i class='bx bxs-cart-add'></i><span>R$25,00</span>
                    </a>
                </li>
                <li class="combos__item">
                    <img src="../img/combos/Combo-Full-300x300.png" alt="Combo Full">
                    <a href="#" class="combos__link">
                        <i class='bx bxs-cart-add'></i><span>R$28,00</span>
                    </a>
                </li>
            </ul>
        </section>

        <!-- Produtos -->
        <section class="products" id="cardapio">
            <h2 class="products__title">Cardápio</h2>
            <div class="products__grid">
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <div class="product">
                        <img src="../php/Produto/exibir_imagem.php?id=<?= $row['ID_Produto'] ?>" alt="<?= $row['Nome_Produto'] ?>">
                        <h3 class="product__name"><?= $row['Nome_Produto'] ?></h3>
                        <p class="product__price">Preço: R$ <?= number_format($row['Preco_Produto'], 2, ',', '.') ?></p>
                        <p class="product__description"><?= $row['Descricao_Produto'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- About -->
        <section class="about" id="sobre">
            <div class="about__text">
                <h2 class="about__title">Sobre Nós</h2>
                <p class="about__description">"Bem-vindo ao Prime Delivery! Nós existimos para satisfazer sua fome por comidas deliciosas e práticas. Com um cardápio diversificado e uma entrega rápida, estamos comprometidos em tornar suas refeições mais convenientes e saborosas. Aqui acreditamos que a boa comida deve estar ao alcance de todos. Conte conosco para satisfazer seus desejos de fast food sempre que você precisar. Obrigado por escolher a nossa equipe para suas refeições. Estamos ansiosos para continuar servindo você da melhor maneira possível."</p>
            </div>
            <div class="about__image">
                <img src="../img/banner_sobre_nos.png" alt="Sobre Nós">
            </div>
        </section>
    </main>
    <!-- Rodapé -->
    <footer class="footer" id="contato">
        <div class="footer__container">
          <!-- Seção da Marca -->
          <div class="footer__brand">
            <img src="../img/Delivery Logotipo .png" alt="Prime Delivery" width="120">
            <div class="footer__social">
              <a href="#" class="footer__social-link bx bxl-facebook-circle"></a>
              <a href="#" class="footer__social-link bx bxl-twitter"></a>
              <a href="#" class="footer__social-link bx bxl-linkedin"></a>
              <a href="#" class="footer__social-link bx bxl-instagram-alt"></a>
            </div>
          </div>
      
          <!-- Seção de Contato -->
          <div class="footer__contact">
            <h3 class="footer__title">Faça seu pedido</h3>
            <p class="footer__info bx bx-phone">(91) 6666 - 6666</p>
            <p class="footer__info bx bxl-whatsapp">(91) 6666 - 6666</p>
            <a href="mailto:contato@primedelivery.com" class="footer__link">
              <i class="bx bx-envelope"></i>contato@primedelivery.com
            </a>
          </div>
      
          <!-- Seção de Localização -->
          <div class="footer__location">
            <h3 class="footer__title">Localização</h3>
            <p class="footer__address">
              Rua da desesperança, nº66 <br>
              Bairro da Desolação <br>
              Cidade do Lamento Noturno
            </p>
          </div>
        </div>
      
        <!-- Direitos Autorais -->
        <div class="direitos">
          <p>&copy; 2023 - Todos os direitos reservados</p>
        </div>
      </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                autoplay: true,
                dots: true,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    </script>
</body>
</html>