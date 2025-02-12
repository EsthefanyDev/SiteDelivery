<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Delivery</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/estilo-cadastro_produtos.css">
</head>
<body>
    <!------------- INICIO DA BARRA DE NAVEGAÇÃO SUPERIOR ------------->
    <header class="topo-site">
        <a href="1pagina-Index.php" class="logo">
            <img src="../img/Delivery Logotipo .png" alt="logo" width="80">
        </a>
        <h1>ADMINISTRADOR</h1>
        <div class="sair">
            <a href="Codigo-Sair_da_Conta.php" id="logout"><i class='bx bx-log-out-circle'></i></a>
        </div>
    </header>
    <nav class="menu">
        <a href="#">Dashboard</a>
        <a href="gerenciar_pedidos.php">Pedidos</a>
        <a href="pagina-Cadastro_Cliente.html">Usuários</a>
        <a href="#cadastro-produtos" class="active">Produtos</a>
        <a href="relatorios.php">Relatórios</a>
        <a id="inicio" href="index.php">Prime Delivery</a>
    </nav> 
    
    <!--------------- INICIO CADASTRO DE PRODUTOS--------------->
    <section class="cadastro-produtos">
        <div class="box">
            <img src="../img/database2.png" width="200px" alt="">
            <a href="../php/Paginas_PHP/5pagina-Tabela_Produtos.php" class="btn">Ver Produtos Cadastrados</a>
        </div>
        <form class="box-cadastro" action="../php/Produto/Codigo-Cadastro_Produtos.php" method="post" enctype="multipart/form-data">
            <h2>Cadastro de Produtos</h2>

          

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            
            <label for="imagem">Imagem do Produto:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <option value="">Selecione uma categoria</option>
                <?php
                include('..\php\conexaoDB.php'); // Certifique-se de que a conexão está correta

                $sql = "SELECT ID_Categoria, Nome_Categoria FROM Categorias";
                $resultado = $conexao->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<option value='{$row['ID_Categoria']}'>{$row['Nome_Categoria']}</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma categoria encontrada</option>";
                }

                $conexao->close();
                ?>
            </select>



            
            <input type="submit" value="Confirmar">
        </form>
    </section>
</body>
</html>