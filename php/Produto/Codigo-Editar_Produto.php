<?php
include "../conexaoDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_Produto = $_POST['ID_Produto'];
    $Nome_Produto = $_POST['Nome_Produto'];
    $Preco_Produto = $_POST['Preco_Produto'];
    $Descricao_Produto = $_POST['Descricao_Produto'];
    $Tipo_Imagem = $_POST['Tipo_Imagem'];
    $Categoria_ID = $_POST['Categoria'];

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
        $conexao->close();
        exit();
    }

    $stmt_check->close();

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['Imagem']) && $_FILES['Imagem']['error'] === UPLOAD_ERR_OK) {
        // Verifica se o arquivo é uma imagem válida
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['Imagem']['type'];

        if (!in_array($fileType, $allowedTypes)) {
            echo "Erro: Tipo de arquivo não permitido. Apenas imagens JPEG, PNG e GIF são aceitas.";
            $conexao->close();
            exit();
        }

        $Imagem = file_get_contents($_FILES['Imagem']['tmp_name']);
        $Tipo_Imagem = $fileType;

        $sql = "UPDATE produtos SET 
                Nome_Produto = ?, 
                Preco_Produto = ?, 
                Descricao_Produto = ?, 
                Imagem = ?, 
                Tipo_Imagem = ?, 
                fk_Categoria_ID_Categoria = ?
                WHERE ID_Produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "sdsssii",
            $Nome_Produto,
            $Preco_Produto,
            $Descricao_Produto,
            $Imagem,
            $Tipo_Imagem,
            $Categoria_ID,
            $ID_Produto
        );
    } else {
        // Atualiza sem a nova imagem
        $sql = "UPDATE produtos SET 
                Nome_Produto = ?, 
                Preco_Produto = ?, 
                Descricao_Produto = ?, 
                fk_Categoria_ID_Categoria = ?
                WHERE ID_Produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "sdsii",
            $Nome_Produto,
            $Preco_Produto,
            $Descricao_Produto,
            $Categoria_ID,
            $ID_Produto
        );
    }

    if ($stmt->execute()) {
        // Redireciona após a atualização bem-sucedida
        header("Location: ../Paginas_PHP/5pagina-Tabela_Produtos.php");
        exit();
    } else {
        echo "Erro ao salvar o registro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    echo "Método de requisição inválido.";
}