<?php
include "../conexaoDB.php";

// Validação do ID do Produto
if (!isset($_GET['ID_Produto']) || !is_numeric($_GET['ID_Produto'])) {
    die("ID do produto inválido.");
}

$ID_Produto = intval($_GET['ID_Produto']);

// Usando prepared statements para evitar SQL injection
$SQL = "SELECT p.*, c.Nome_Categoria 
        FROM produtos p
        INNER JOIN categorias c ON p.fk_Categoria_ID_Categoria = c.ID_Categoria
        WHERE p.ID_Produto = ?";
$stmt = $conexao->prepare($SQL);
$stmt->bind_param("i", $ID_Produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();
    $Nome_Produto = htmlspecialchars($dados['Nome_Produto']);
    $Preco_Produto = htmlspecialchars($dados['Preco_Produto']);
    $Descricao_Produto = htmlspecialchars($dados['Descricao_Produto']);
    $Imagem = $dados['Imagem'];
    $Tipo_Imagem = $dados['Tipo_Imagem'];
    $Categoria_Atual = $dados['Nome_Categoria']; 
} else {
    die("Produto não encontrado.");
}

// Busca todas as categorias disponíveis
$SQL_Categorias = "SELECT ID_Categoria, Nome_Categoria FROM categorias";
$resultadoCategorias = $conexao->query($SQL_Categorias);

if (!$resultadoCategorias) {
    die("Erro ao buscar categorias: " . $conexao->error);
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Editar Produto</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-image: url(../../img/Z-Background.png);
    }
    div {
        display: flex;
        color: #FFD700;
        padding: 10px;
        width: 100%;
    }
    div a, i {
        font-size: 20px;
        font-weight: 600;
        color: #FFD700;
        margin: 10px;
        text-decoration: none;
    }
    div a:hover {
        text-decoration: underline;
    }
    form {
        background-color: #fff;
        width: 300px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-style: double;
        border-color: #FFD700;
    }
    h1 {
        color: #581A84;
        text-align: center;
    }
    label {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #581A84;
    }
    input, select{
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #581A84;
        color: white;
        cursor: pointer;
        font-size: 16px;
        font-weight: normal;
    }
    input[type="submit"]:hover {
        background-color: #480048;
    }
    img {
        max-width: 100%;
        height: auto;
        margin-bottom: 15px;
    }
</style>
<body>
    <div>
        <a href="5pagina-Tabela_Produtos.php"><i class='bx bx-left-arrow-circle'></i>Voltar</a><br><br>
    </div>
    <form action="../Produto/Codigo-Editar_Produto.php" method="post" enctype="multipart/form-data">
        <h1>Editar Produto</h1>

        <input type="hidden" name="ID_Produto" value="<?php echo $ID_Produto; ?>">

        <label>Nome Produto:</label><br>
        <input type="text" name="Nome_Produto" value="<?php echo $Nome_Produto; ?>"><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="Preco_Produto" value="<?php echo $Preco_Produto; ?>"><br>

        <label>Descrição:</label><br>
        <input type="text" name="Descricao_Produto" value="<?php echo $Descricao_Produto; ?>"><br>
        
        <label>Categoria:</label><br>
        <select name="Categoria">
            <?php while ($categoria = $resultadoCategorias->fetch_assoc()): ?>
                <option value="<?php echo $categoria['ID_Categoria']; ?>" <?php echo ($categoria['Nome_Categoria'] == $Categoria_Atual) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($categoria['Nome_Categoria']); ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label>Imagem:</label><br>
        <input type="file" name="Imagem"><br>
        <?php if (!empty($Imagem)): ?>
            <img src="data:<?php echo $Tipo_Imagem; ?>;base64,<?php echo base64_encode($Imagem); ?>" alt="Imagem do Produto" style="max-width: 100px;"><br>
            <input type="hidden" name="Imagem_Atual" value="<?php echo base64_encode($Imagem); ?>">
            <input type="hidden" name="Tipo_Imagem_Atual" value="<?php echo $Tipo_Imagem; ?>">
        <?php endif; ?>

        <br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>