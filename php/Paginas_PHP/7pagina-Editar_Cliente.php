<?php
    include "../conexaoDB.php";

    $ID_Cliente = $_GET['ID_Cliente'];

    $SQL = "SELECT  * FROM Cliente WHERE ID_Cliente=$ID_Cliente";

    $Cliente = $mysqli->query($SQL) or die("Erro na busca do cliente");

    if ($Cliente->num_rows > 0){

        $dados = $Cliente->fetch_assoc();
        $Nome_Cliente = $dados['Nome_Cliente'];
        $Senha_Cliente = $dados['Senha_Cliente'];
        $Endereco_Cliente = $dados['Endereco_Cliente'];
        $Celular = $dados['Celular'];

    }
    else die("Cliente não encontrado");
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
	<meta charset="utf-8"/>
	<title>Meu primeiro script PHP</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-image: url(background-02.png);
    }
    div {
        display: flex;
        color:#FFD700; 
        padding: 10px;
        width: 100%;
    }
    div a, i{
        font-size: 20px;
        font-weight: 600;
        color: #FFD700;
        margin: 10px;
        text-decoration: none;
    }
    div a:hover {
        text-decoration: underline;
    }
    form {
        background-color: #fff;
        width: 300px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-style:double ;
        border-color: #FFD700;
    }
    h1{
        color: #581A84;
        text-align: center;
    }
    label {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #581A84;
    }
    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #581A84;
        color: white;
        cursor: pointer;
        font-size: 16px;
        font-weight:normal;
    }
    input[type="submit"]:hover {
        background-color: #480048;
    }
    </style>
<body>
    <div>
        <a href="5pagina-Tabela_Clientes.php"><i class='bx bx-left-arrow-circle'></i>Voltar</a><br><br>
    </div>

    <form action="../Cliente/Codigo-Editar_Cliente.php" method="post">
        <h1>Editar Cadastro</h1>

        <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>">

        <label>Nome_Cliente:</label><br>
        <input type="text" name="Nome_Cliente" value="<?php echo $Nome_Cliente;?>"><br>
        
        <label>Celular:</label><br>
        <input type="text" name="Celular" value="<?php echo $Celular;?>"><br>

        <label>Senha_Cliente:</label><br>
        <input type="text" name="Senha_Cliente" value="<?php echo $Senha_Cliente;?>"><br>

        <label>Celular:</label><br>
        <input type="text" name="Endereco_Cliente" value="<?php echo $Endereco_Cliente;?>"><br>

        <br><br>

        <input type="submit" value="Salvar" >
        
    </form>
</body>
</html>