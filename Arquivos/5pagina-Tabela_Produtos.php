<?php 
    include "conexaoDB.php";
    $sql = "SELECT * FROM produtos ORDER BY Nome_Produto"; 
    $produtos = $mysqli->query($sql) or die("Erro na busca dos Produtos"); 
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="utf-8"/>
    <title>CRUD</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Style-Tabelas.css">
</head>
<body>
    <div class="topo">
        <a href="4pagina-Cadastro_Produtos.html"><i class='bx bx-left-arrow-circle'></i>Voltar</a><br><br>
        <h1>Produtos cadastrados</h1>
        <a href="4pagina-Cadastro_Produtos.html" class="novoC">Adicionar novo Produto</a>
    </div> 
    <?php
       if ($produtos->num_rows == 0) echo "<p>Não existem produtos cadastrados</p>";
       else{
    ?>   
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th width="200">Nome do produto</th>
                <th>Preço</th>
                <th>Descrição</th>
                <!-- <th>imagem</th> -->
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
                    
                    <!-- <td><?php echo $dados['Imagem_path'];?></td> -->
                    <td>
                        <a href="7pagina-Editar_Produto.php?ID_Produto=<?php echo $dados['ID_Produto'];?>"><i class='bx bx-edit'></i></a>
                        <a href="6pagina-Excluir_Produto.php?ID_Produto=<?php echo $dados['ID_Produto'];?>"><i class='bx bx-trash'></i></a>
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