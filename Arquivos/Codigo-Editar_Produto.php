<?php 

    include "conexaoDB.php";

    $ID_Produto = $_POST['ID_Produto'];
    $Nome_Produto = $_POST['Nome_Produto'];
    $Preco_Produto = $_POST['Preco_Produto'];
    $Descricao_Produto = $_POST['Descricao_Produto'];
    $Imagem_Path = $_POST['Imagem_Path'];

     $sql = "UPDATE produtos SET Nome_Produto ='$Nome_Produto', Preco_Produto ='$Preco_Produto', Descricao_Produto = '$Descricao_Produto'
             WHERE ID_Produto = $ID_Produto";

     if ($mysqli->query($sql)) echo "Registro Salvo"; 
     else echo "Erro ao salvar o registro";        

     $mysqli->close();

     header("Location: 5pagina-Tabela_Produtos.php");

?>