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
</head>
<body>
    <a href="cadastro.html">Cadastrar cliente</a><br><br>
    <a href="inicial.html">Voltar para a pagina principal</a><br><br>
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
                                    <a href="editarT_Cliente.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>">
                                        <img src="img/edit.png" width="20">
                                    </a>
                                    <a href="excluirT_Cliente.php?ID_Cliente=<?php echo $dados['ID_Cliente'];?>">
                                        <img src="img/trash.png" width="20">
                                    </a>
                                    
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