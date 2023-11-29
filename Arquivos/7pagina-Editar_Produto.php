<?php
    include "conexaoDB.php";

    $ID_Produto = $_GET['ID_Produto'];

    $SQL = "SELECT  * FROM produtos WHERE ID_Produto=$ID_Produto";

    $produto = $mysqli->query($SQL) or die("Erro na busca do cliente");

    if ($produto->num_rows > 0){

        $dados = $produto->fetch_assoc();
        $Nome_Produto = $dados['Nome_Produto'];
        $Preco_Produto = $dados['Preco_Produto'];
        $Descricao_Produto = $dados['Descricao_Produto'];
        $Imagem_Path = $dados['Imagem_Path'];

    }
    else die("Produto não encontrado");
?>
<!DOCTYPE html>
<html lang="ptbr">
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
        background-image: url(Z-Background.png);
    }
    div {
        display: flex;
        color:#FFD700; 
        padding: 10px;
        width: 100%;
    }
    div a, i{
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
        border-style:double ;
        border-color: #FFD700;
    }
    h1{
        color: #581A84;
        text-align: center;
    }
    label {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #581A84;
    }
    input {
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
        font-weight:normal;
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
    <form action="Codigo-Editar_Produto.php" method="post">
        <h1>Editar Produto</h1>

        <input type="hidden" name="ID_Produto" value="<?php echo $ID_Produto; ?>">

        <label>Nome_Produto:</label><br>
        <input type="text" name="Nome_Produto" value="<?php echo $Nome_Produto;?>"><br>
        
        <label>Preço:</label><br>
        <input type="decimal" name="Preco_Produto" value="<?php echo $Preco_Produto;?>"><br>

        <label>Descrição:</label><br>
        <input type="text" name="Descricao_Produto" value="<?php echo $Descricao_Produto;?>"><br>

        <label>Imagem:</label><br>
        <input type="file" name="Imagem_Path" value="<?php echo $Imagem_Path;?>"><br>

        <br><br>

        <input type="submit" value="Salvar" >
    </form>
</body>
</html>