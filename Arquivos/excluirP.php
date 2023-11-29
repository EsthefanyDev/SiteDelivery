    <?php
        include "conexaoDB.php";

        $ID_Produto = $_POST['ID_Produto'];

        $SQL = "DELETE FROM produtos WHERE ID_Produto = $ID_Produto";

        $mysqli->query($SQL) or die("Query falhou");

        header("Location: 5pagina-Tabela_Produtos.php");

    ?>