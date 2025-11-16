<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Aluguel de Ferramentas</title>
    
    <link rel="stylesheet" href="View/css/style.css"> 
    
    <style>
        .login-container {
            max-width: 450px; /* Deixa o cartão de login mais estreito */
            margin-top: 50px; /* Mais espaço no topo */
        }
    </style>
</head>
<body>

<main class="login-container"> 

    <?php
    // Bloco PHP para exibir mensagem de erro
    if (isset($_GET['status']) && $_GET['status'] == 'login_invalido') {
        echo '<p style="color: red; font-weight: bold; border: 1px solid red; padding: 10px; border-radius: 5px;">E-mail ou senha inválidos. Tente novamente.</p>';
    }
    if (isset($_GET['status']) && $_GET['status'] == 'acesso_negado_cliente') {
        echo '<p style="color: red; font-weight: bold; border: 1px solid red; padding: 10px; border-radius: 5px;">Acesso negado. Por favor, faça login como cliente.</p>';
    }
    if (isset($_GET['status']) && $_GET['status'] == 'acesso_negado') {
        echo '<p style="color: red; font-weight: bold; border: 1px solid red; padding: 10px; border-radius: 5px;">Acesso negado. Esta área é restrita.</p>';
    }
    ?>

    <div style="text-align: center;">
        <h1>Acesse sua Conta</h1>
    </div>

    <form action="index.php" method="POST">
        
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email_usuario" required>
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha_usuario" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" name="acao_login">
                ENTRAR
            </button>
        </div>
    </form>

    <hr>

    <p style="text-align: center;">Ainda não tem uma conta?</p>
    <p style="text-align: center; margin-top: -10px;">
        <a href="index.php?pagina=cadastro">Crie uma aqui!</a>
    </p>

</main> </body>
</html>