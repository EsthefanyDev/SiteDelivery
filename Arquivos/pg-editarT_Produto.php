<?php 

    include "conexaoDB";

    $Id_Produto = $_POST['id'];
    $Nome_Produto = $_POST['nome'];
    $Valor_Produto = $_POST['valor'];
    $Descricao_Produto = $_POST['descrição'];

     $sql = "UPDATE produtos SET nome ='$Nome_Produto', valor ='$Valor_Produto', descrição ='$Descricao_Produto'
             WHERE id = $Id_Produto";

     if ($db->query($sql)) echo "Registro Salvo"; 
     else echo "Erro ao salvar o registro";        

     $db->close();

     header("Location: pg-Database_Produtos.php");

?>