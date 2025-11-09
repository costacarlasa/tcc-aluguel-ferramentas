<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Aluguel de Ferramentas</title>
    </head>
<body>
    <?php
    // Bloco PHP para exibir mensagem de erro
    if (isset($_GET['status']) && $_GET['status'] == 'login_invalido') {
        echo '<p style="color: red; font-weight: bold;">E-mail ou senha inválidos. Tente novamente.</p>';
    }
    ?>

    <h1>Acesse sua Conta</h1>

    <form action="index.php" method="POST">
        
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email_usuario" required>
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha_usuario" required>
        </div>

        <div>
            <button type="submit" name="acao_login">
                ENTRAR
            </button>
        </div>
    </form>

    <hr>

    <p>Ainda não tem uma conta?</p>
    <a href="index.php?pagina=cadastro">Crie uma aqui!</a>

</body>
</html>