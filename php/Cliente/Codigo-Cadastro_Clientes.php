<?php
session_start();

// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "prime_delivery";

// Conecta ao banco de dados
$conexao = mysqli_connect($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Função para limpar e validar dados de entrada
function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpa e valida os dados de entrada
    $Nome_Cliente = cleanInput($_POST['Nome_Cliente']);
    $Senha_Cliente = cleanInput($_POST['Senha_Cliente']);
    $Endereco_Cliente = cleanInput($_POST['Endereco_Cliente']);
    $Celular = cleanInput($_POST['Celular']);

    // Verifica se o usuário já existe
    $sql_code = "SELECT * FROM Cliente WHERE Nome_Cliente = ? OR Senha_Cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql_code);
    mysqli_stmt_bind_param($stmt, "ss", $Nome_Cliente, $Senha_Cliente);
    mysqli_stmt_execute($stmt);
    $retorno = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($retorno) > 0) {
        // Mensagem de erro com estilo
        echo '
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Erro</title>
            <style>
                .message {
                    padding: 15px;
                    margin: 20px auto;
                    border-radius: 5px;
                    width: 80%;
                    max-width: 500px;
                    text-align: center;
                    font-family: Arial, sans-serif;
                }
                .error {
                    background-color: #ffebee;
                    border: 1px solid #ffcdd2;
                    color: #c62828;
                }
                .error a {
                    color: #c62828;
                    text-decoration: none;
                    font-weight: bold;
                }
                .error a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="message error">
                Esse usuário já existe, clique aqui para fazer o <a href="../../html/pagina-Login.html">Login</a>
            </div>
        </body>
        </html>
        ';
    } else {
        // Insere o novo usuário no banco de dados
        $sql_code = "INSERT INTO cliente (ID_Cliente, Nome_Cliente, Senha_Cliente, Endereco_Cliente, Celular) 
                     VALUES (NULL, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql_code);
        mysqli_stmt_bind_param($stmt, "ssss", $Nome_Cliente, $Senha_Cliente, $Endereco_Cliente, $Celular);
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            // Mensagem de sucesso com estilo
            echo '
                <!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sucesso</title>
                <style>
                    .message {
                    padding: 20px;
                    margin: 20px auto;
                    border-radius: 10px;
                    width: 80%;
                    max-width: 500px;
                    text-align: center;
                    font-family: Arial, sans-serif;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .success {
                        background-color: #e8f5e9;
                        border: 1px solid #c8e6c9;
                        color: #2e7d32;
                    }
                    .success a {
                        color: #2e7d32;
                        text-decoration: none;
                        font-weight: bold;
                    }
                    .success a:hover {
                        text-decoration: underline;
                    }
                    .loader {
                        border: 4px solid #f3f3f3;
                        border-top: 4px solid #2e7d32;
                        border-radius: 50%;
                        width: 30px;
                        height: 30px;
                        animation: spin 1s linear infinite;
                        margin: 10px auto;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            </head>
            <body>
                <div class="message success">
                    <p>Usuário cadastrado com sucesso!</p>
                    <div class="loader"></div>
                    <p>Redirecionando em <span id="countdown">5</span> segundos...</p>
                    <p><a href="../../html/pagina-Login.html">Clique aqui para fazer login agora</a></p>
                </div>
                <script>
                    // Contador regressivo
                    let countdown = 5;
                    const countdownElement = document.getElementById("countdown");
                    setInterval(() => {
                        countdown--;
                        countdownElement.textContent = countdown;
                    }, 1000);
                </script>
            </body>
            </html>
            ';
            // Redireciona após 5 segundos
            header("Refresh: 5; url=../../html/pagina-Login.html");
            exit();
        } else {
            echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        }
    }

    // Fecha o statement
    mysqli_stmt_close($stmt);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
