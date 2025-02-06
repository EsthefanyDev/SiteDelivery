<?php
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : 'Ocorreu um erro inesperado.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .mensagem {
            font-size: 18px;
            margin-bottom: 20px;
            color: red;
        }
        .link {
            color: #581A84;
            text-decoration: none;
            font-weight: bold;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mensagem"><?php echo htmlspecialchars($mensagem); ?></div>
        <a href="cadastro_produto.php" class="link">Tentar novamente</a> | 
        <a href="lista_produtos.php" class="link">Voltar à lista de produtos</a>
    </div>
</body>
</html>