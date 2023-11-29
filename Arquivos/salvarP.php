<?php 

    include "conexao.php";

    $Nome_Produto = $_POST['Nome_Produto'];
    $Preco_Produto = $_POST['Preco_Produto'];
    $Descricao_Produto = $_POST['Descricao_Produto'];
    $Imagem_path = $_POST['Imagem_path'];

     $sql = "INSERT INTO produtos ( Nome_Produto, Preco_Produto, Descricao_Produto, Imagem_Path) 
     VALUES ( '$Nome_Produto', '$Preco_Produto', '$Descricao_Produto', ' $Imagem_path')";

     if ($mysqli->query($sql)) echo "Registro Salvo"; 
     else echo "Erro ao salvar o registro";        

     $mysqli->close();

     header("Location:teste-Database_Poduto.php");

?>