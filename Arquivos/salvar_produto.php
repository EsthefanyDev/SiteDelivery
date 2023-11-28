<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "prime_delivery");

// Verificar a conexão
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}

// Processamento do formulário
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];

// Upload da imagem
$imagemPath = 'uploads/' . basename($_FILES['imagem']['name']);
move_uploaded_file($_FILES['imagem']['tmp_name'], $imagemPath) or die('Erro ao fazer upload da imagem.');

// Inserir dados na tabela Produtos
$sql = "INSERT INTO Produtos (Nome_Produto, Preco_Produto, Descricao_Produto, Imagem_Path) 
        VALUES ('$nome', $preco, '$descricao', '$imagemPath')";

// Executar a query e exibir mensagem
echo ($mysqli->query($sql)) ? 'Produto cadastrado com sucesso.' : 'Erro ao cadastrar o produto: ' . $mysqli->error;

// Fechar a conexão
$mysqli->close();
echo '<br> <br>';
echo '<a href="index.php">Voltar à Página Inicial</a>';
?>
