<?php 
    include "conexaoDB.php";

    $sql = "SELECT * FROM Cliente ORDER BY Nome_Cliente";
   
    $Cliente = $mysqli->query($sql) or die("Erro na busca dos Clientes"); 
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
        <h1>Clientes cadastrados</h1>
        <a href="3pagina-Cadastro_Clientes.html" class="novoC">Adicionar novo cliente</a>
    </div> 
    <?php
       if ($Cliente->num_rows == 0) echo "<p>Não existem Cliente cadastrados</p>";
       else{
    ?>   
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th width="200">Nome_Cliente</th>
                <th>Senha_Cliente</th>
                <th>Endereco_Cliente</th>
                <th>Celular</th>
                <th></th>
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
                <td>
                    <a href="7pagina-Editar_Cliente.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>"><i class='bx bx-edit'></i></a>
                    <a href="6pagina-Excluir_Cliente.php.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>"><i class='bx bx-trash'></i></a>
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