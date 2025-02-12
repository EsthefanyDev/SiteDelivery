<?php
include "../conexaoDB.php";

// Verifica se o ID do produto foi passado na URL
if (!isset($_GET['ID_Produto'])) {
    die("Erro: ID do produto não foi passado na URL.");
}

// Verifica se o ID do produto é um número válido
if (!is_numeric($_GET['ID_Produto'])) {
    die("Erro: ID do produto deve ser um número.");
}

$ID_Produto = intval($_GET['ID_Produto']); // Converte para inteiro

// Consulta o banco de dados para obter o nome do produto
$SQL = "SELECT Nome_Produto FROM produtos WHERE ID_Produto = ?";
$stmt = $conexao->prepare($SQL);

if ($stmt) {
    $stmt->bind_param("i", $ID_Produto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        $Nome_Produto = htmlspecialchars($dados['Nome_Produto']);
    } else {
        die("Erro: Produto não encontrado no banco de dados.");
    }

    $stmt->close();
} else {
    die("Erro ao preparar a consulta: " . $mysqli->error);
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Excluir Produto?</title>
</head>
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
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 50%;
        text-align: center;
        border-style: double;
    }
    label {
        font-weight: bold;
        margin-bottom: 15px;
        display: block;
    }
    input[type="submit"], input[type="button"] {
        background-color: #581A84;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        margin: 0 10px;
    }
    input[type="submit"]:hover, input[type="button"]:hover {
        background-color: #480048;
    }
</style>
<body>
    <form action="../Produto/Codigo-Excluir_Produto.php" method="post">
        <input type="hidden" name="ID_Produto" value="<?php echo $ID_Produto; ?>">
        <label>Deseja mesmo excluir o produto <?php echo $Nome_Produto; ?>?</label><br>
        <br><br>
        <input type="submit" value="Sim">
        <input type="button" onclick="history.go(-1)" value="Não">
    </form>
</body>
</html>