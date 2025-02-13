<?php 
    include "../conexaoDB.php";

    $sql = "SELECT * FROM Cliente ORDER BY Nome_Cliente";
   
    $Cliente = $conexao->query($sql) or die("Erro na busca dos Clientes"); 
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="utf-8"/>
    <title>CRUD</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/Style-Tabelas.css">
</head>
<body>
    <!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
    <header class="topo-site">
        <a href="1pagina-Index.php" class="logo">
            <img src="../../img/Delivery Logotipo .png" alt="logo" width="80">
        </a>
        <h1>ADIMINISTRADOR</h1>
        <div class="sair">
            <a href="Codigo-Sair_da_Conta.php" id="logout"><i class='bx bx-log-out-circle'></i></a>
        </div>
    </header>
    <nav class="menu">
        <a href="#">Dashboard</a>
        <a href="gerenciar_pedidos.php">Pedidos</a>
        <a href="../../html/3pagina-Cadastro_Clientes.html" class="active">Usuários</a>
        <a href="../../html/pagina-Cadastro_Produtos.php">Produtos</a>
        <a href="relatorios.php">Relatórios</a>
        <a id="inicio" href="../php/Paginas_PHP/1pagina-Index.php">Prime Delivery</a>
    </nav> 

    <?php
       if ($Cliente->num_rows == 0) echo "<p>Não existem Cliente cadastrados</p>";
       else{
    ?>   
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th width="200">Nome</th>
                <th>Senha</th>
                <th>Endereço</th>
                <th>Celular</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($dados = $Cliente->fetch_assoc()) {
            ?>  
           <tr>
                <td><?php echo $dados['ID_Cliente'];?></td>
                <td><?php echo $dados['Nome_Cliente'];?></td>
                <td><?php echo $dados['Senha_Cliente'];?></td>
                <td><?php echo $dados['Endereco_Cliente'];?></td>
                <td><?php echo $dados['Celular'];?></td>
                <td><a href="7pagina-Editar_Cliente.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>"><i class='bx bx-edit'></i></a></td>
                <td><a href="6pagina-Excluir_Cliente.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>"><i class='bx bx-trash'></i></a></td>
            </tr>
            <?php
                }
            ?>   
        </tbody>
    </table>    
    <?php
       }
       $conexao->close();
    ?>
</body>
</html>