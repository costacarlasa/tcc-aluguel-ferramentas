<?php
require_once '../Model/Usuario.php';

if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {

    $senha = $_POST['senha_usuario'];
    $confirmar_senha = $_POST['confirmar_senha_usuario'];

    if ($senha !== $confirmar_senha) {
        die("Erro: As senhas digitadas não conferem!");
    }

    $usuario = new Usuario();

    $usuario->setNome($_POST['nome_usuario']);
    $usuario->setEmail($_POST['email_usuario']);
    $usuario->setTelefone($_POST['telefone_usuario']);
    $usuario->setEndereco($_POST['endereco_usuario']);
    $usuario->setCategoriaCliente($_POST['categoria_cliente']);
    $usuario->setCpfCnpj($_POST['cpf_cnpj_usuario']);
    $usuario->setSenha($senha); // Passa a senha (será criptografada no Model)


    $sucesso = $usuario->cadastrar();


    if ($sucesso) {
        echo "<h1>Cadastro realizado com sucesso!</h1>";
        echo "<p>Seja bem-vindo(a)!</p>";
        echo '<a href="../View/login.php">Ir para a página de Login</a>';
    } else {
        echo "<h1>Ops! Ocorreu um erro ao realizar o cadastro.</h1>";
        echo '<p>Por favor, tente novamente. Se o problema persistir, pode ser que este e-mail já esteja em uso.</p>';
        echo '<a href="../View/cadastro.php">Voltar para o Cadastro</a>';
    }
} else {
    echo "Acesso não permitido.";
}
?>