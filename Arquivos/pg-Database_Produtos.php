<?php
$conexao = mysqli_connect("localhost", "root", "", "prime_delivery");

if ($conexao->connect_error) {
    die('Erro na conexão: ' . $conexao->connect_error);
}

$consultaDosProdutos = "SELECT * FROM Produtos";
$resultadoConsulta = $conexao->query($consultaDosProdutos);
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtos - Prime Delivery</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <style>    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
        }
        :root {
            --Roxo:  #581A84;
            --Prata: #C0C0C0;
            --Dourado: #FFD700;
            --Preto: #000;
            --Branco: #FFF;
        }
        body{
            background-image: url(background-02.png);
        }
        .topo {
            background-color: var(--Preto);
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topo a {
            color: var(--Dourado);
            text-decoration: none;
            margin: 0 10px;
        }
        .topo a:hover {
            text-decoration: underline;
        }

        h1 {
            margin: 0;
        }
        table{
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-top: 30px;
            background-color: var(--Branco);
        }
        th, td {
            border: 1px solid var(--Preto);
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: var(--Dourado);
        }

        tr:hover {
            background-color: var(--Prata);
        }
        .topo{
            display: flex;
        }
        .bx-edit{
            font-size: 30px;
            color: #581A84;
        }
        .bx-trash{
            font-size: 30px;
            color: red;
        }
    </style>
    </head>

    <body>

        <!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
            <div class="topo">
                <a href="pg-RegistreProdutos.html"> Voltar</a>
                <h1>Produtos Cadastrados</h1>
                <a href=""></a>
            </div>
        <section class="produtos">
            <table border="1">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Produto</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($linhaProduto = $resultadoConsulta->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $linhaProduto['ID_Produto'] . '</td>';
                        echo '<td>' . $linhaProduto['Nome_Produto'] . '</td>';
                        echo '<td>R$ ' . $linhaProduto['Preco_Produto'] . '</td>';
                        echo '<td>' . $linhaProduto['Descricao_Produto'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </body>

</html>