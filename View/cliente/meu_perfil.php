<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Meu Perfil</h2>
    <p>Olá, <?= htmlspecialchars($_SESSION['nome_usuario']) ?>. Aqui você pode atualizar seus dados.</p>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'sucesso_edicao'): ?>
            <p style="color: green; border: 1px solid green; padding: 10px;">Perfil atualizado com sucesso!</p>
        <?php elseif ($_GET['status'] == 'erro_edicao'): ?>
            <p style="color: red; border: 1px solid red; padding: 10px;">Ocorreu um erro ao atualizar seu perfil.</p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($usuario) && $usuario): ?>
        <form action="index.php" method="POST">
            
            <div>
                <label>Nome Completo:</label>
                <input type="text" name="nome_usuario" value="<?= htmlspecialchars($usuario['nomeUsuario']) ?>" required>
            </div>
            
            <div>
                <label>Telefone:</label>
                <input type="text" name="telefone_usuario" value="<?= htmlspecialchars($usuario['telefoneUsuario']) ?>">
            </div>

            <div>
                <label>Endereço:</label>
                <input type="text" name="endereco_usuario" value="<?= htmlspecialchars($usuario['enderecoUsuario']) ?>">
            </div>

            <hr>
            <p>Os campos abaixo não podem ser alterados:</p>
            <div>
                <label>E-mail:</label>
                <input type="email" value="<?= htmlspecialchars($usuario['emailUsuario']) ?>" disabled>
            </div>
            <div>
                <label>CPF/CNPJ:</label>
                <input type="text" value="<?= htmlspecialchars($usuario['cpf_cnpjUsuario']) ?>" disabled>
            </div>
            
            <button type="submit" name="acao_editar_perfil">Salvar Alterações</button>
        </form>
    <?php else: ?>
        <p style="color: red;">Não foi possível carregar os dados do seu perfil.</p>
    <?php endif; ?>
</main>
</body>
</html>