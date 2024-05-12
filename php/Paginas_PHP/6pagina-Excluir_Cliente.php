<?php
    include "conexaoDB.php";

    $ID_Cliente = $_GET['ID_Cliente'];

    $SQL = "SELECT  Nome_Cliente FROM Cliente WHERE ID_Cliente=$ID_Cliente";

    $Cliente = $mysqli->query($SQL) or die("Erro na busca do cliente");

    if ($Cliente->num_rows > 0){

        $dados = $Cliente->fetch_assoc();
        $Nome_Cliente = $dados['Nome_Cliente'];
           
    }
    else die("Cliente não encontrado");
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="utf-8"/>
    <title>Meu primeiro script PHP</title>
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

    <form action="Codigo-Excluir_Cliente.php" method="post">
        <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>">

        <label>Deseja mesmo excluir o cliente <?php echo $Nome_Cliente;?>?</label><br>
        
        <br><br>

        <input type="submit" value="Sim">
        <input type="button" onclick="history.go(-1)" value="Não">
        
    </form>

</body>
</html>



