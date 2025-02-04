<?php
// Configuração do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "prime_delivery";

// Conexão com o banco de dados
$mysqli = new mysqli($host, $user, $password, $database);

// Verifica erro de conexão
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

// Pega o ID do produto na URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$id) {
    die("ID do produto não foi especificado.");
}

// Consulta para buscar a imagem e o tipo MIME
$sql = "SELECT Imagem, Tipo_Imagem FROM Produtos WHERE ID_Produto = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

// Verifica se encontrou a imagem
if ($stmt->num_rows > 0) {
    $stmt->bind_result($imagem, $tipoImagem);
    $stmt->fetch();

    // Define o cabeçalho correto para exibir a imagem
    header("Content-Type: " . $tipoImagem);
    echo $imagem;
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Imagem não encontrada.";
}

// Fecha a conexão
$stmt->close();
$mysqli->close();
?>
