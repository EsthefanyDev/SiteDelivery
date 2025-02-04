<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "prime_delivery";

// Inicializa a conexão com o banco de dados
$mysqli = new mysqli($host, $user, $password, $database);

// Verifica se houve erro na conexão
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}

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

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($preco) || empty($descricao)) {
        die('Todos os campos são obrigatórios.');
    }

    // Verifica se o arquivo de imagem foi enviado
    if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
        die('Erro no upload da imagem.');
    }

    // Verifica se o arquivo é uma imagem válida
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($_FILES['imagem']['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        die('Tipo de arquivo não permitido. Apenas imagens JPEG, PNG e GIF são aceitas.');
    }

    // Lê o conteúdo binário da imagem
    $imagemBinaria = file_get_contents($_FILES['imagem']['tmp_name']);
    if ($imagemBinaria === false) {
        die('Erro ao ler o arquivo de imagem.');
    }

    // Prepara a query SQL usando prepared statements para prevenir SQL injection
    $sql = "INSERT INTO Produtos (Nome_Produto, Preco_Produto, Descricao_Produto, Imagem, Tipo_Imagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die('Erro na preparação da query: ' . $mysqli->error);
    }

    // Vincula os parâmetros à query
    $stmt->bind_param('sdsss', $nome, $preco, $descricao, $imagemBinaria, $fileType);

    // Executa a query
    if ($stmt->execute()) {
        $mensagem = 'Produto cadastrado com sucesso.';
    } else {
        $mensagem = 'Erro ao cadastrar o produto: ' . $stmt->error;
    }

    // Fecha a statement e a conexão
    $stmt->close();
    $mysqli->close();

    echo $mensagem;
} else {
    die('Método de requisição inválido.');
}
?>