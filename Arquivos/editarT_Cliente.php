<?php
    include "conexaoDB.php";

    $ID_Cliente = $_GET['ID_Cliente'];

    $SQL = "SELECT  * FROM Cliente WHERE ID_Cliente=$ID_Cliente";

    $Cliente = $mysqli->query($SQL) or die("Erro na busca do cliente");

    if ($Cliente->num_rows > 0){

           $dados = $Cliente->fetch_assoc();

           $Nome_Cliente = $dados['Nome_Cliente'];
           $Senha_Cliente = $dados['Senha_Cliente'];
           $Endereco_Cliente = $dados['Endereco_Cliente'];
           $Celular = $dados['Celular'];

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

    <form action="editar.php" method="post">

        <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>">

        <label>Nome_Cliente:</label><br>
        <input type="text" name="Nome_Cliente" value="<?php echo $Nome_Cliente;?>"><br>
        
        <label>Celular:</label><br>
        <input type="text" name="Celular" value="<?php echo $Celular;?>"><br>

        <label>Senha_Cliente:</label><br>
        <input type="text" name="Senha_Cliente" value="<?php echo $Senha_Cliente;?>"><br>

        <label>Celular:</label><br>
        <input type="text" name="Endereco_Cliente" value="<?php echo $Endereco_Cliente;?>"><br>

        <br><br>

        <input type="submit" value="Enviar" >
        
    </form>

</body>
</html>