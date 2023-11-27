
<?php
// Conectar ao banco de dados
$conexaoD = mysqli_connect("localhost", "root", "", "prime_delivery");

// Verificar a conexão
if ($conexaoD->connect_error) {
    die('Erro na conexão: ' . $conexaoD->connect_error);
}

// Consultar produtos no banco de dados
$sql = "SELECT * FROM Produtos";
$resultado = $conexaoD->query($sql);
?>

<!DOCTYPE html>
<html lang="Pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Delivery</title>
    <!--INICIO CSS ICONES-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- INICIO LINK CSS -->
    <link rel="stylesheet" href="css/paginainicial.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    
</head>

<body>

    <!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
    <header class="topo-site">
        <!-- INICIO DA LOGO MARCA -->
        <a   href="paginainicial.php" class="logo">
            <img src="img/logos/logo-amarelo_roxo-removebg.png" alt="logo" width="80">
        </a>
        <!-- FIM DA LOGO MARCA -->

        <!-- INICIO MENU -->
        <nav>
            <a href="#inicio">Ínicio</a>
            <a href="#combos">Lanches</a>
            <a href="#sobre">Sobre</a>
            <a href="#contato">contato</a>
        </nav>
        <!-- FIM MENU -->

        <!-- INICIO ICONES -->
        <div class="icons">
            <a href="login.html" id="login"><i class='bx bxs-user'></i>Entrar</a>

            <a href="sair.php" id="logout"><i class='bx bx-log-out'>Sair</i></a>
            
        </div>
        <!-- FIM ICONES -->
      
    </header>
    <!---------- FIM DA BARRA DE NAVEGAÇÃO SUPERIOR ----------->
    
    <!------------- INICIO DO BANNER ------------->
     
    <div class="banner" id="inicio" style="position: relative;">
        
        <div class="texto-sobre-img">
            <h1>JÁ PEDIU </h1>
            <h2>SEU LANCHE HOJE?</h2>
        </div>
    </div>    
    <!------------- FIM DO BANNER HOME DO SITE ------------->
    <main class="page" >
        
        <!------------- INICIO DA AREA DE COMBOS ------------->
        <section class="combos">
           
            <div class="nossosLanches" id="combos">
                <h2>Nossos Lanches</h2>
            </div>
            <div class="produtos">
                
                <div class="container-produtos">
                
                    <?php
                        // Exibir os produtos
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<div class="produto">';
                            echo '<img src="' . $row['Imagem_Path'] . '" alt="Imagem do Produto">';
                            echo '<h3>' . $row['Nome_Produto'] . '</h3>';
                            echo '<p class="preco">Preço: R$ ' . $row['Preco_Produto'] . '</p>';
                            echo '<p class="descricao">' . $row['Descricao_Produto'] . '</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </section>
            
        <!------------- FIM DA AREA DE COMBOS ------------->


        <!--------------- INICIO DA AREA SOBRE --------------->
        <section class="sobre" id="sobre">
            <div class="text">
                <h2>Sobre Nós</h2>
                <p>"Bem-vindo ao Prime Delivery! Nós existimos para satisfazer sua fome por comidas deliciosas e práticas. Com um cardápio diversificado e uma entrega rápida, estamos comprometidos em tornar suas refeições mais convenientes e saborosas. Aqui acreditamos que a boa comida deve estar ao alcance de todos. Conte conosco para satisfazer seus desejos de fast food sempre que você precisar. Obrigado por escolher a nossa equipe para suas refeições. Estamos ansiosos para continuar servindo você da melhor maneira possível."</p>
            </div>
            <div class="motinha">
                <img src="img/banner-03.png" alt="" width="600">
            </div>
        </section>
        <!--------------- FIM DA AREA SOBRE --------------->

    </main>  

    <!--------------- INICIO DO RODAPE --------------->
    <footer>
        <section class="rodape">    
            <div class="box-conteiner" id="contato">

                <!--------------- INICIO ITEM DO RODAPE --------------->
                <div class="box">
                    <img src="img/logos/Prime-Delivery-Roxo-e-Branco-150x150.png" alt="Prime Delivery" width="120">
                    <p>"Saboreie o melhor da cidade sem sair de casa."</p>

                    <div class="redes-sociais">    
                        <a href="" class="bx bxl-facebook-circle"></a>
                        <a href="" class="bx bxl-twitter"></a>
                        <a href="" class="bx bxl-linkedin"></a>  
                        <a href="" class="bx bxl-instagram-alt"></a>
                    </div>
                </div>    
                <!--------------- FIM ITEM DO RODAPE --------------->

                <!--------------- INICIO ITEM DO RODAPE --------------->
                <div class="box">    
                    <h3>Faça seu pedido</h3>
                    <p class="bx bx-phone">(91) 6666 - 6666</p> <br>
                    <p class="bx bxl-whatsapp">(91) 6666 - 6666</p> <br>
                    <a href="" class="link"><i class="bx bx-envelope"></i>contato@primedelivery.com</a>
                </div>    
                <!--------------- FIM ITEM DO RODAPE --------------->
                
                <!--------------- INICIO ITEM DO RODAPE --------------->
                <div class="box">    
                    <h3>Localização</h3>
                    <p>
                        Rua da desesperança, nº66 <br>
                        Bairro da Desolação <br>
                        Cidade do Lamento Noturno

                    </p>
                </div>    
                <!--------------- FIM ITEM DO RODAPE --------------->
            </div>
           
        </section>  
        <div class="direitos">
            <p>&copy; 2023 - Todos os direitos reservados</p>
        </div>       
    </footer>
    <!--------------- FIM DO RODAPE --------------->

   <!----------- INICIO LINK JAVASCRIPT ----------->
   <script src="js/script.js"></script>
</body>

</html>
