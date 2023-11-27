<?php
    include "conexaoDB";

    $Id_Produto = $_POST['id'];
    

    $SQL = "DELETE FROM produtos
            WHERE id = $Id_Produto";

    $db->query($SQL) or die("Query falhou");

    header("Location: produtos.php");

?>