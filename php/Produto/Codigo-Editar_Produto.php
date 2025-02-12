<?php
include "../conexaoDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_Produto = $_POST['ID_Produto'];
    $Nome_Produto = $_POST['Nome_Produto'];
    $Preco_Produto = $_POST['Preco_Produto'];
    $Descricao_Produto = $_POST['Descricao_Produto'];

    // Verifica se o nome do produto já existe (exceto para o produto atual)
    $sql_check = "SELECT ID_Produto FROM produtos WHERE Nome_Produto = ? AND ID_Produto != ?";
    $stmt_check = $conexao->prepare($sql_check);
    $stmt_check->bind_param("si", $Nome_Produto, $ID_Produto);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Nome do produto já existe
        echo "Erro: Já existe um produto com esse nome.";
        $stmt_check->close();
        $mysqli->close();
        exit();
    }

    $stmt_check->close();

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['Imagem']) && $_FILES['Imagem']['error'] === UPLOAD_ERR_OK) {
        $Imagem = file_get_contents($_FILES['Imagem']['tmp_name']);
        $Tipo_Imagem = $_FILES['Imagem']['type'];

        $sql = "UPDATE produtos SET 
                Nome_Produto = ?, 
                Preco_Produto = ?, 
                Descricao_Produto = ?, 
                Imagem = ?, 
                Tipo_Imagem = ? 
                WHERE ID_Produto = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param(
            "sdsssi",
            $Nome_Produto,
            $Preco_Produto,
            $Descricao_Produto,
            $Imagem,
            $Tipo_Imagem,
            $ID_Produto
        );
    } else {
        $sql = "UPDATE produtos SET 
                Nome_Produto = ?, 
                Preco_Produto = ?, 
                Descricao_Produto = ? 
                WHERE ID_Produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "sdsi",
            $Nome_Produto,
            $Preco_Produto,
            $Descricao_Produto,
            $ID_Produto
        );
    }

    if ($stmt->execute()) {
        echo "Registro salvo com sucesso!";
    } else {
        echo "Erro ao salvar o registro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();

    header("Location: ../Paginas_PHP/5pagina-Tabela_Produtos.php");
    exit();
} else {
    echo "Método de requisição inválido.";
}