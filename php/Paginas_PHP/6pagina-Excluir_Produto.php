<?php
    include "conexaoDB.php";

    $ID_Produto = $_GET['ID_Produto'];

    $SQL = "SELECT  Nome_Produto FROM produtos WHERE ID_Produto=$ID_Produto";

    $produtos = $mysqli->query($SQL) or die("Erro na busca do produto");

    if ($produtos->num_rows > 0){

        $dados = $produtos->fetch_assoc();

        $Nome_Produto = $dados['Nome_Produto'];
           
    }
    else die("Produto não encontrado");
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="utf-8"/>
    <title>Excluir Produto?</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url(background-02.png);
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
    <form action="Codigo-Excluir_Produto.php" method="post">
        <input type="hidden" name="ID_Produto" value="<?php echo $ID_Produto; ?>">
        <label>Deseja mesmo excluir o produto <?php echo $Nome_Produto;?>?</label><br>
        <br><br>
        <input type="submit" value="Sim">
        <input type="button" onclick="history.go(-1)" value="Não">
    </form>
</body>
</html>



