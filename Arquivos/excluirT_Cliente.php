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
<body>

    <form action="excluir.php" method="post">
        <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>">

        <label>Deseja mesmo excluir o cliente <?php echo $Nome_Cliente;?>?</label><br>
        
        <br><br>

        <input type="submit" value="Sim">
        <input type="button" onclick="history.go(-1)" value="Não">
        
    </form>

</body>
</html>



