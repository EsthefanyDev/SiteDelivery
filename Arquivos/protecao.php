<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['ID_Cliente'])) {
    die("Vosê não pode acessar essa pagina porque você não esta logado.<p><a href=\"cadastro.html\">Entrar</a></p>");
}

?>