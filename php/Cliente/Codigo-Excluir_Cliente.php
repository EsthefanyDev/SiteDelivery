<?php
    include "conexaoDB.php";

    $ID_Cliente   = $_POST['ID_Cliente'];
    

    $SQL = "DELETE FROM Cliente
            WHERE ID_Cliente = $ID_Cliente";

    $mysqli->query($SQL) or die("Query falhou");

    header("Location: 5pagina-Tabela_Clientes.php");
?>
