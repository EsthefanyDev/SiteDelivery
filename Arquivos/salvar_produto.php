<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Produto - Prime Delivery</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(background-02.png);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .mensagem {
            background-color: white;
            color: green;
            font-size: 20px;
            font-weight: 600;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }
        a{
            color: white;
            text-decoration: none;
            padding: 10px;
            background-color:#581A84;
            border-radius: 5px;
            bo

        }
    </style>
</head>

<body>

    <?php
    $mysqli = new mysqli("localhost", "root", "", "prime_delivery");

    if ($mysqli->connect_error) {
        die('Erro na conexão: ' . $mysqli->connect_error);
    }

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $imagemPath = 'uploads/' . basename($_FILES['imagem']['name']);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $imagemPath) or die('Erro ao fazer upload da imagem.');

    $sql = "INSERT INTO Produtos (Nome_Produto, Preco_Produto, Descricao_Produto, Imagem_Path) 
            VALUES ('$nome', $preco, '$descricao', '$imagemPath')";

    $mensagem = ($mysqli->query($sql)) ? 'Produto cadastrado com sucesso.' : 'Erro ao cadastrar o produto: ' . $mysqli->error;

    $mysqli->close();
    ?>

    <div class="mensagem">
        <p><?php echo $mensagem; ?></p>
        <a href="pg-RegistreProdutos.html">OK</a>
    </div>        

</body>

</html>

