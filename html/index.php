<?php
include('../php/conexaoDB.php');

function buscarProdutosPorCategoria($conexao, $categoria) {
    $sql = "
        SELECT p.* FROM Produtos p INNER JOIN Categorias c ON p.fk_Categoria_ID_Categoria = c.ID_Categoria WHERE c.Nome_Categoria = '$categoria'
    ";
    $resultado = $conexao->query($sql);

    if (!$resultado) {
        die('Erro na consulta: ' . $conexao->error);
    }

    return $resultado;
}
$combos = buscarProdutosPorCategoria($conexao, 'Combos');
$pizzas = buscarProdutosPorCategoria($conexao, 'Pizzas');
$hamburgueres = buscarProdutosPorCategoria($conexao, 'Hamburgueres');
$acompanhamentos = buscarProdutosPorCategoria($conexao, 'Acompanhamentos');
$bebidas = buscarProdutosPorCategoria($conexao, 'Bebidas');
?>
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
    <!-- Cabeçalho -->
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
                <a href="../html/3pagina-Cadastro_Clientes.html" class="header__button user-plus"><i class="bx bxs-user-plus"></i>Cadastre-se</a>
                <a href="../html/pagina-Login.html" class="header__button"><i class="bx bxs-user"></i>Entrar</a>
            </div>
        </div>
    </header>
    <main>
        <!-- Carrossel de Banner -->
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
                <?php while ($combo = $combos->fetch_assoc()): ?>
                    <li class="combos__item">
                        <img src="../php/Produto/exibir_imagem.php?id=<?= $combo['ID_Produto'] ?>" alt="<?= htmlspecialchars($combo['Nome_Produto']) ?>">
                        
                            <h3 class="combo__name"><?= htmlspecialchars($combo['Nome_Produto']) ?></h3>
                            
                            <p class="combo__description"><?= htmlspecialchars($combo['Descricao_Produto']) ?></p>
                            <span id="combo__price">R$ <?= number_format($combo['Preco_Produto'], 2, ',', '.') ?></span> 
                        
                        <div class="quantity-control" data-product-id="<?= $combo['ID_Produto'] ?>">
                            <button type="button" class="quantity-button decrease">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                            <input type="tel" class="quantity-input" value="0">
                            <button type="button" class="quantity-button increase">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <line x1="12" y1="4" x2="12" y2="20" stroke="currentColor" stroke-width="2" />
                                    <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                            <button type="button" class="add-to-cart" data-product-id="<?= $combo['ID_Produto'] ?>">
                                Adicionar
                            </button>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>

        <!-- Produtos -->
        <section class="products" id="cardapio">
            <h2 class="products__title">Cardápio</h2>

            <!-- Seção de Pizzas -->
            <div class="products__category">
                <h3 class="products__category__title">Pizzas</h3>
                <div class="products__grid">
                    <?php while ($pizza = $pizzas->fetch_assoc()): ?>
                        <div class="product">
                            <img src="../php/Produto/exibir_imagem.php?id=<?= $pizza['ID_Produto'] ?>" alt="<?= $pizza['Nome_Produto'] ?>">
                            <h3 class="product__name"><?= $pizza['Nome_Produto'] ?></h3>
                            <p class="product__description"><?= $pizza['Descricao_Produto'] ?></p>
                            <p class="product__price"><span>Preço:</span> <br> R$ <?= number_format($pizza['Preco_Produto'], 2, ',', '.') ?></p>
                            <div class="quantity-control" data-product-id="<?= $pizza['ID_Produto'] ?>">
                                <button type="button" class="quantity-button decrease">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <input type="tel" class="quantity-input" value="0">
                                <button type="button" class="quantity-button increase">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="12" y1="4" x2="12" y2="20" stroke="currentColor" stroke-width="2" />
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <!-- Botão "Adicionar ao Carrinho" -->
                                <button type="button" class="add-to-cart" data-product-id="<?= $pizza['ID_Produto'] ?>">
                                Adicionar
                            </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Seção de Hamburgueres -->
            <div class="products__category">
                <h3 class="products__category__title">Hamburgueres</h3>
                <div class="products__grid">
                    <?php while ($hamburguer = $hamburgueres->fetch_assoc()): ?>
                        <div class="product">
                            <img src="../php/Produto/exibir_imagem.php?id=<?= $hamburguer['ID_Produto'] ?>" alt="<?= $hamburguer['Nome_Produto'] ?>">
                            <h3 class="product__name"><?= $hamburguer['Nome_Produto'] ?></h3>
                            <p class="product__description"><?= $hamburguer['Descricao_Produto'] ?></p>
                            <p class="product__price"><span>Preço:</span> <br> R$ <?= number_format($hamburguer['Preco_Produto'], 2, ',', '.') ?></p>
                            <div class="quantity-control" data-product-id="<?= $hamburguer['ID_Produto'] ?>">
                                <button type="button" class="quantity-button decrease">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <input type="tel" class="quantity-input" value="0">
                                <button type="button" class="quantity-button increase">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="12" y1="4" x2="12" y2="20" stroke="currentColor" stroke-width="2" />
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <!-- Botão "Adicionar ao Carrinho" -->
                                <button type="button" class="add-to-cart" data-product-id="<?= $hamburguer['ID_Produto'] ?>">
                                Adicionar
                            </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Seção de Acompanhamentos -->
            <div class="products__category">
                <h3 class="products__category__title">Acompanhamentos</h3>
                <div class="products__grid">
                    <?php while ($acompanhamento = $acompanhamentos->fetch_assoc()): ?>
                        <div class="product">
                            <img src="../php/Produto/exibir_imagem.php?id=<?= $acompanhamento['ID_Produto'] ?>" alt="<?= $acompanhamento['Nome_Produto'] ?>">
                            <h3 class="product__name"><?= $acompanhamento['Nome_Produto'] ?></h3>
                            <p class="product__description"><?= $acompanhamento['Descricao_Produto'] ?></p>
                            <p class="product__price"><span>Preço:</span> <br> R$ <?= number_format($acompanhamento['Preco_Produto'], 2, ',', '.') ?></p>
                            <div class="quantity-control" data-product-id="<?= $acompanhamento['ID_Produto'] ?>">
                                <button type="button" class="quantity-button decrease">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <input type="tel" class="quantity-input" value="0">
                                <button type="button" class="quantity-button increase">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="12" y1="4" x2="12" y2="20" stroke="currentColor" stroke-width="2" />
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <!-- Botão "Adicionar ao Carrinho" -->
                                <button type="button" class="add-to-cart" data-product-id="<?= $acompanhamento['ID_Produto'] ?>">
                                Adicionar
                            </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Seção de Bebidas -->
            <div class="products__category">
                <h3 class="products__category__title">Bebidas</h3>
                <div class="products__grid">
                    <?php while ($bebida = $bebidas->fetch_assoc()): ?>
                        <div class="product">
                            <img src="../php/Produto/exibir_imagem.php?id=<?= $bebida['ID_Produto'] ?>" alt="<?= $bebida['Nome_Produto'] ?>">
                            <h3 class="product__name"><?= $bebida['Nome_Produto'] ?></h3>
                            <p class="product__description"><?= $bebida['Descricao_Produto'] ?></p>
                            <p class="product__price"><span>Preço:</span> <br> R$ <?= number_format($bebida['Preco_Produto'], 2, ',', '.') ?></p>
                            <div class="quantity-control" data-product-id="<?= $bebida['ID_Produto'] ?>">
                                <button type="button" class="quantity-button decrease">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <input type="tel" class="quantity-input" value="0">
                                <button type="button" class="quantity-button increase">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <line x1="12" y1="4" x2="12" y2="20" stroke="currentColor" stroke-width="2" />
                                        <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                                <!-- Botão "Adicionar ao Carrinho" -->
                                <button type="button" class="add-to-cart" data-product-id="<?= $bebida['ID_Produto'] ?>">
                                Adicionar
                            </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
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
              <a href="#" class="footer__social-link bx bxl-instagram-alt"></a>
            </div>
          </div>
          
          <!-- Seção de Contato -->
          <div class="footer__contact">
            <h3>Faça seu pedido</h3>
            <p><i class="bx bx-phone"></i>(91) 6666 - 6666</p>
            <p><i class="bx bxl-whatsapp"></i>(91) 6666 - 6666</p>
            <a href="mailto:contato@primedelivery.com"><i class="bx bx-envelope"></i>contato@primedelivery.com</a>
          </div>
          
          <!-- Seção de Localização -->
          <div class="footer__location">
            <h3>Localização</h3>
            <p>
              Rua da desesperança, nº66 <br>
              Bairro da Desolação <br>
              Cidade do Lamento Noturno
            </p>
          </div>
        </div>
        
        <!-- Direitos Autorais -->
        <div class="footer__copyright">
          <p>&copy; 2023 - Todos os direitos reservados</p>
        </div>
      </footer>
    <!-- Scripts -->
    <script src="../js/script.js"></script>
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