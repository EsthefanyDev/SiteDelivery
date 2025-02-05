<?php 
    include "../conexaoDB.php";
    $sql = "SELECT * FROM produtos ORDER BY Nome_Produto"; 
    $produtos = $mysqli->query($sql) or die("Erro na busca dos Produtos"); 
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
        <h1>ADMINISTRADOR</h1>
        <div class="sair">
            <a href="Codigo-Sair_da_Conta.php" id="logout"><i class='bx bx-log-out-circle'></i></a>
        </div>
    </header>
    <nav class="menu">
        <a href="#">Dashboard</a>
        <a href="gerenciar_pedidos.php">Pedidos</a>
        <a href="5pagina-Tabela_Clientes.php">Usuários</a>
        <a href="#cadastro-produtos" class="active">Produtos</a>
        <a href="relatorios.php">Relatórios</a>
        <a id="inicio" href="../php/Paginas_PHP/1pagina-Index.php">Prime Delivery</a>
    </nav> 

    <?php
       if ($produtos->num_rows == 0) echo "<p>Não existem produtos cadastrados</p>";
       else{
    ?>   
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th width="200">Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>imagem</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while ($dados = $produtos->fetch_assoc()) {
                ?>  
                <tr>
                    <td><?php echo $dados['ID_Produto'];?></td>
                    <td><?php echo $dados['Nome_Produto'];?></td>
                    <td><?php echo $dados['Preco_Produto'];?></td>
                    <td><?php echo $dados['Descricao_Produto'];?></td>
                    <!-- <td><?php echo $dados['Imagem'];?></td> -->
                    <td><?php echo $dados['Tipo_Imagem'];?></td>
                    <td><a href="7pagina-Editar_Produto.php?ID_Produto=<?php echo $dados['ID_Produto'];?>"><i class='bx bx-edit'></i></a></td>
                    <td><a href="../Paginas_PHP/6pagina-Excluir_Produto.php?php echo $dados['ID_Produto'];?>"><i class='bx bx-trash'></i></a>
                    </td>    
                </tr>
                <?php
                    }
                ?>   
            </tbody>
        </table>    
        <?php
            }
            $mysqli->close();
        ?>
    </body>
</html>