<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Crie sua Conta</h2>

    <form action="salvar_usuario.php" method="POST">
        Nome Completo: <input type="text" name="nome" required><br><br>
        E-mail: <input type="email" name="email" required><br><br>
        Telefone: <input type="text" name="telefone" required><br><br>
        Endereço Completo: <input type="text" name="endereco" required><br><br>

        Categoria:
        <input type="radio" name="categoria" value="Pessoa Física" required> Pessoa Física
        <input type="radio" name="categoria" value="Pessoa Jurídica"> Pessoa Jurídica
        <br><br>

        CPF / CNPJ: <input type="text" name="documento" required><br><br>
        Senha: <input type="password" name="senha" required><br><br>
        Confirmar Senha: <input type="password" name="confirmar" required><br><br>

        <input type="submit" value="Criar Conta">
    </form>

    <p>Já tem conta? <a href="login.php">Faça login</a></p>
</body>
</html>
