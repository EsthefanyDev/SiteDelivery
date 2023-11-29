<?php

session_start();

$conexao = mysqli_connect("localhost", "root", "", "prime_delivery");
if(!$conexao) {
    echo"Nao conectado ";
}
echo"Conectado";

$Nome_Cliente = $_POST['Nome_Cliente'];
$Senha_Cliente = $_POST['Senha_Cliente'];
$Nome_Cliente = mysqli_real_escape_string($conexao, $Nome_Cliente);
$Senha_Cliente = mysqli_real_escape_string($conexao, $Senha_Cliente);
$sql_code = "SELECT * FROM Cliente WHERE Nome_Cliente = '$Nome_Cliente' OR Senha_Cliente = '$Senha_Cliente'";
$retorno = mysqli_query($conexao, $sql_code);

if(mysqli_num_rows($retorno)>0) {
    echo 'Esse usuário já existe, clique aqui pra fazer o  <a href="2pagina-Login.html"> Login</a>';;
} else {

    $Nome_Cliente = $_POST['Nome_Cliente'];
    $Senha_Cliente = $_POST['Senha_Cliente'];
    $Endereco_Cliente = $_POST['Endereco_Cliente'];
    $Celular = $_POST['Celular'];

    $sql_code = "INSERT INTO cliente (ID_Cliente, Nome_Cliente, Senha_Cliente, Endereco_Cliente, Celular) 
    VALUES (NULL, '$Nome_Cliente', '$Senha_Cliente', '$Endereco_Cliente', '$Celular')";
    $resultado = mysqli_query($conexao, $sql_code);
    echo"Usuario cadastrado";
    header("Location: 2pagina-Login.html");
}
?>
