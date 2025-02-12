<?php
$usuario = 'root';
$senha = '';
$database = 'prime_delivery';
$host = 'localhost';

$conexao = new mysqli($host, $usuario, $senha, $database);

if ($conexao->connect_error){
    die("Falha ao conectar ao banco de dados: ". $conexao->connect_error);
}
?> 