<?php
include('../../php/conexaoDB.php');

if(isset($_POST['Nome_Cliente']) || isset($_POST['Senha_Cliente'])) {

    if(strlen($_POST['Nome_Cliente'])==0) {
        echo "Preencha seu Nome";
    } else if(strlen($_POST['Senha_Cliente'])==0) {
        echo "Preencha sua Senha";
    } else {
        
        $Nome_Cliente = $conexao->real_escape_string($_POST['Nome_Cliente']);
        $Senha_Cliente = $conexao->real_escape_string($_POST['Senha_Cliente']);

        $sql_code = "SELECT * FROM Cliente WHERE Nome_Cliente = '$Nome_Cliente' AND Senha_Cliente = '$Senha_Cliente'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execucao" . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['ID_Cliente'] = $usuario['ID_Cliente'];
            $_SESSION['Nome_Cliente'] = $usuario['Nome_Cliente'];
    
            header("Location: ../../html/pagina-Cadastro_Produtos.php");

        } else {
            echo "Falha: Usuário ou Senha incorretos";
        }
    }
}
?>