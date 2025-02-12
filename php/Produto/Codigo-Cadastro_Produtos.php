<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Delivery | Cadastro de Produto</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../../img/Z-Background.png);
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
            max-width: 400px;
            width: 100%;
        }

        .mensagem.sucesso {
            font-size:16px;
            color: green;
            border: 3px solid green;
        }

        .mensagem.erro {
            font-size:16px;
            color: red;
            border: 3px solid red;
        }

        a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #581A84;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            background-color: #3a1159;
        }
    </style>
</head>

<body>
    <?php
    include('../conexaoDB.php');

    // Função para sanitizar entradas
    function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Verifica se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitiza e valida os dados de entrada
        $nome = isset($_POST['nome']) ? sanitizeInput($_POST['nome']) : null;
        $preco = isset($_POST['preco']) ? (float)$_POST['preco'] : null;
        $descricao = isset($_POST['descricao']) ? sanitizeInput($_POST['descricao']) : null;
        $categoria_d = isset($_POST['categoria']) ? (int)$_POST['categoria'] : null; // CORRIGIDO PONTO-E-VÍRGULA

        // Verifica se todos os campos obrigatórios foram preenchidos
        if (empty($nome) || empty($preco) || empty($descricao) || empty($categoria_d)) {
            echo '<div class="mensagem erro">Todos os campos são obrigatórios.</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
            exit();
        }

        // Verifica se o arquivo de imagem foi enviado
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            echo '<div class="mensagem erro">Erro no upload da imagem.</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
            exit();
        }

        // Verifica se o arquivo é uma imagem válida
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['imagem']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            echo '<div class="mensagem erro">Tipo de arquivo não permitido. Apenas imagens JPEG, PNG e GIF são aceitas.</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
            exit();
        }

        // Lê o conteúdo binário da imagem
        $imagemBinaria = file_get_contents($_FILES['imagem']['tmp_name']);
        if ($imagemBinaria === false) {
            echo '<div class="mensagem erro">Erro ao ler o arquivo de imagem.</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
            exit();
        }

        // Prepara a query SQL usando prepared statements para prevenir SQL injection
        $sql = "INSERT INTO Produtos (Nome_Produto, Preco_Produto, Descricao_Produto, Imagem, Tipo_Imagem, fk_Categoria_ID_Categoria) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql); // ALTERADO PARA USAR A VARIÁVEL CORRETA

        if ($stmt === false) {
            echo '<div class="mensagem erro">Erro na preparação da query: ' . $conexao->error . '</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
            exit();
        }

        // Vincula os parâmetros à query
        $stmt->bind_param('sdsssi', $nome, $preco, $descricao, $imagemBinaria, $fileType, $categoria_d);

        // Executa a query
        if ($stmt->execute()) {
            echo '<div class="mensagem sucesso">Produto cadastrado com sucesso.</div>';
            echo '<a href="../Paginas_PHP/5pagina-Tabela_Produtos.php">Ver lista de produtos</a>';
        } else {
            echo '<div class="mensagem erro">Erro ao cadastrar o produto: ' . $stmt->error . '</div>';
            echo '<a href="../../html/pagina-Cadastro_Produtos.html">Tentar novamente</a>';
        }

        // Fecha a statement e a conexão
        $stmt->close();
        $conexao->close();
    } else {
        echo '<div class="mensagem erro">Método de requisição inválido.</div>';
        echo '<a href="../../html/pagina-Cadastro_Produtos.html">Voltar ao formulário</a>';
    }
    ?>
</body>

</html>
