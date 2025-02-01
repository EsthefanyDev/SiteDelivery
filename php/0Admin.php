<?php
include('conexaoDB.php');

if(isset($_POST['Usuario']) || isset($_POST['Senha'])) {

    if(strlen($_POST['Usuario'])==0) {
        echo "Preencha seu Nome";
    } else if(strlen($_POST['Senha'])==0) {
        echo "Preencha sua Senha";
    } else {
        
        $Usuario = $mysqli->real_escape_string($_POST['Usuario']);
        $Senha = $mysqli->real_escape_string($_POST['Senha']);

        $sql_code = "SELECT * FROM Admin WHERE Usuario = '$Usuario' AND Senha = '$Senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falhha na execucao" . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['CPF'] = $usuario['CPF'];
            $_SESSION['Usuario'] = $usuario['Usuario'];
    
            header("Location: 5pagina-Tabela_Produtos_Cadastrados.php");

        } else {
            echo "Falha: Usuário ou Senha incorretos";
        }
    }
}
?>