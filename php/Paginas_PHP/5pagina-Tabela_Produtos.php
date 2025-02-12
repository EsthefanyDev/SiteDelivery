<?php 
    include "../conexaoDB.php";
  // Consulta com JOIN para buscar produtos e suas categorias
    $sql = "
    SELECT p.ID_Produto, p.Nome_Produto, p.Preco_Produto, p.Descricao_Produto, p.Imagem, p.Tipo_Imagem, c.Nome_Categoria
    FROM Produtos p
    INNER JOIN Categorias c ON p.fk_Categoria_ID_Categoria = c.ID_Categoria
    ORDER BY p.Nome_Produto
    ";
    $produtos = $conexao->query($sql) or die("Erro na busca dos Produtos: " . $conexao->error);
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
    </header>
    <nav class="menu">
        <a href="#">Dashboard</a>
        <a href="gerenciar_pedidos.php">Pedidos</a>
        <a href="5pagina-Tabela_Clientes.php">Usuários</a>
        <a href="../../html/pagina-Cadastro_Produtos.php" class="active">Produtos</a>
        <a href="relatorios.php">Relatórios</a>
        <a id="inicio" href="../../html/index.php">Prime Delivery</a>
    </nav> 

    <?php
       if ($produtos->num_rows == 0) echo "<p>Não existem produtos cadastrados</p>";
       else{
    ?>   
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Categoria</th>
                <th>Nome</th>
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
                    <td><?php echo $dados['Nome_Categoria']; ?></td> 
                    <td><?php echo $dados['Nome_Produto'];?></td>    
                    <td><?php echo $dados['Preco_Produto'];?></td>
                    <td><?php echo $dados['Descricao_Produto'];?></td>
                    <td>
                        <img src="../Produto/exibir_imagem.php?id=<?php echo $dados['ID_Produto']; ?>" alt="Imagem do Produto" width="100">
                    </td>
                    <td><a href="../Paginas_PHP/7pagina-Editar_Produto.php?ID_Produto=<?php echo $dados['ID_Produto'];?>"><i class='bx bx-edit'></i></a></td>
                    <td><a href="../Paginas_PHP/6pagina-Excluir_Produto.php?ID_Produto=<?php echo $dados['ID_Produto']; ?>"><i class='bx bx-trash'></i></a></td>   
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