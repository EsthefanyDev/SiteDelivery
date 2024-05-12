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
