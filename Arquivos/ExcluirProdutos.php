<?php
    include "conexaoDB.php";

    $ID_Produto = $_POST['ID_Produto'];
    

    $SQL = "DELETE FROM produtos
            WHERE id = $ID_Produto";

    $mysqli->query($SQL) or die("Query falhou");

    // header("Location: pg-Database_Produtos.php");
    header("Location: teste.php");

?>