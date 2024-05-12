<?php
$conexaoD = mysqli_connect("localhost", "root", "", "prime_delivery");

if ($conexaoD->connect_error) {
    die('Erro na conexão: ' . $conexaoD->connect_error);
}

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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Style-Index.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>
    <!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
    <header class="topo-site">
        <a   href="1pagina-Index.php" class="logo">
            <img src="img/logo-amarelo_roxo-removebg.png" alt="logo" width="80">
        </a>
        <nav>
            <a href="#inicio">Ínicio</a>
            <a href="#combos">Lanches</a>
            <a href="#sobre">Sobre</a>
            <a href="#contato">contato</a>
        </nav>
        <div class="icons">
            <a href="2pagina-Login.html" id="login"><i class='bx bxs-user'></i>Entrar</a>
            <a href="Codigo-Sair_da_Conta.php" id="logout"><i class='bx bx-log-out'>Sair</i></a>  
        </div>
    </header>
    <!------------- INICIO DO BANNER ------------->
    <div class="banner" id="inicio" style="position: relative;">
        <div class="texto-sobre-img">
            <h1>JÁ PEDIU </h1>
            <h2>SEU LANCHE HOJE?</h2>
        </div>
    </div>    
    <main class="page" > 
        <!------------- INICIO DA AREA DE COMBOS ------------->
        <section class="combos" id="combos"> 
            <div class="nossosLanches">
                <h2>Nossos Lanches</h2>
            </div>
            <div class="produtos">
                <div class="container-produtos">
                    <?php
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
       
    </main>  
    <!--------------- INICIO DO RODAPE --------------->
    <footer>
        <section class="rodape">    
            <div class="box-conteiner" id="contato">
                <div class="box">
                    <img src="img/Prime-Delivery-Roxo-e-Branco-150x150.png" alt="Prime Delivery" width="120">
                    <p>"Saboreie o melhor da cidade sem sair de casa."</p>

                    <div class="redes-sociais">    
                        <a href="" class="bx bxl-facebook-circle"></a>
                        <a href="" class="bx bxl-twitter"></a>
                        <a href="" class="bx bxl-linkedin"></a>  
                        <a href="" class="bx bxl-instagram-alt"></a>
                    </div>
                </div>   
                <div class="box">    
                    <h3>Faça seu pedido</h3>
                    <p class="bx bx-phone">(91) 6666 - 6666</p> <br>
                    <p class="bx bxl-whatsapp">(91) 6666 - 6666</p> <br>
                    <a href="" class="link"><i class="bx bx-envelope"></i>contato@primedelivery.com</a>
                </div>    
                <div class="box">    
                    <h3>Localização</h3>
                    <p>
                        Rua da desesperança, nº66 <br>
                        Bairro da Desolação <br>
                        Cidade do Lamento Noturno
                    </p>
                </div>    
            </div>
        </section>  
        <div class="direitos">
            <p>&copy; 2023 - Todos os direitos reservados</p>
        </div>       
    </footer>
    <!--------------- FIM DO RODAPE --------------->
</body>
</html>
