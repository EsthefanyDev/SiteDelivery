<?php 

    include "conexao.php";

    $Nome_Cliente = $_POST['Nome_Cliente'];
    $Senha_Cliente = $_POST['Senha_Cliente'];
    $Endereco_Cliente = $_POST['Endereco_Cliente'];
    $Celular = $_POST['Celular'];

     $sql = "INSERT INTO cliente ( Nome_Cliente, Senha_Cliente, Endereco_Cliente, Celular) 
     VALUES ( '$Nome_Cliente', '$Senha_Cliente', '$Endereco_Cliente', '$Celular')";

     if ($mysqli->query($sql)) echo "Registro Salvo"; 
     else echo "Erro ao salvar o registro";        

     $mysqli->close();

     header("Location:Database_Cliente.php");

?>