<?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "root", "", "prime_delivery");

// Verificar a conexão
if ($conexao->connect_error) {
    die('Erro na conexão: ' . $conexao->connect_error);
}

// Consultar produtos no banco de dados
$sql = "SELECT * FROM Produtos";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos - Prime Delivery</title>
    <link rel="stylesheet" href="css/inicial.css">
    <link rel="stylesheet" href="css/produtos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
<header class="topo-site">
    <!-- INICIO DA LOGO MARCA -->
    <a href="paginainicial.php" class="logo">
        <img src="img/logo-amarelo_roxo-removebg.png" alt="logo" width="80">
    </a>
    <!-- FIM DA LOGO MARCA -->

    <!-- INICIO MENU -->
    <nav class="menu-site">
        <a href="RegistreProdutos.html"> Voltar</a>
        <a href="EditarProdutos.php">Editar Tabela</a>
    </nav>
    <!-- FIM MENU -->
</header>
<!---------- FIM DA BARRA DE NAVEGAÇÃO SUPERIOR ----------->
<h1>Produtos</h1>

<body>


    <!-- Barra de navegação e outros elementos comuns podem ser reutilizados aqui -->

    <section class="produtos">
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
    </section>

    <footer>
        <section class="rodape">
            <div class="box-conteiner" id="contato">

                <!--------------- INICIO ITEM DO RODAPE --------------->
                <div class="box">
                    <img src="img/Prime-Delivery-Roxo-e-Branco-150x150.png" alt="Prime Delivery" width="120">

                    <div class="redes-sociais">
                        <a href="" class="bx bxl-facebook-circle"></a>
                        <a href="" class="bx bxl-twitter"></a>
                        <a href="" class="bx bxl-linkedin"></a>
                        <a href="" class="bx bxl-instagram-alt"></a>
                    </div>
                </div>
                <!--------------- FIM ITEM DO RODAPE --------------->

                <!--------------- INICIO ITEM DO RODAPE --------------->
                <div class="box" id="contatos">
                    <h3>Contatos</h3>
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
            <div class="direitos">
                <p>&copy; 2023 - Todos os direitos reservados</p>
            </div>
        </section>
    </footer>

</body>

</html>