<?php 

    include "../conexaoDB.php";

    $ID_Cliente = $_POST['ID_Cliente'];
    $Nome_Cliente = $_POST['Nome_Cliente'];
    $Senha_Cliente = $_POST['Senha_Cliente'];
    $Endereco_Cliente = $_POST['Endereco_Cliente'];
    $Celular = $_POST['Celular'];

     $sql = "UPDATE Cliente SET Nome_Cliente='$Nome_Cliente', Senha_Cliente='$Senha_Cliente', Endereco_Cliente='$Endereco_Cliente', Celular='$Celular'
             WHERE ID_Cliente = $ID_Cliente";

     if ($mysqli->query($sql)) echo "Registro Salvo"; 
     else echo "Erro ao salvar o registro";        

     $mysqli->close();

     header("Location: ../Paginas_PHP/5pagina-Tabela_Clientes.php");

?>