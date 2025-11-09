<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário - Primeiro Acesso</title>
</head>
<body>
    <h1>Crie sua Conta</h1>

    <form action="index.php" method="POST">

        <div>
            <label>Nome Completo:</label>
            <input type="text" name="nome_usuario" required>
        </div>

        <div>
            <label>E-mail:</label>
            <input type="email" name="email_usuario" required>
        </div>

        <div>
            <label>Telefone:</label>
            <input type="text" name="telefone_usuario">
        </div>

        <div>
            <label>Endereço:</label>
            <input type="text" name="endereco_usuario">
        </div>

        <div>
            <label>Tipo Usuário:</label>
            <input type="radio" name="categoria_cliente" value="PF" checked> Pessoa Física
            <input type="radio" name="categoria_cliente" value="PJ"> Pessoa Jurídica
        </div>

        <div>
            <label>CPF / CNPJ:</label>
            <input type="text" name="cpf_cnpj_usuario" required>
        </div>

        <div>
            <label>Senha:</label>
            <input type="password" name="senha_usuario" required>
        </div>

        <div>
            <label>Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" required>
        </div>

        <div>
            <button type="submit" name="acao_cadastrar">
                CRIAR CONTA
            </button>
        </div>
    </form>
</body>
</html>