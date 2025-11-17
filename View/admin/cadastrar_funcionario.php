<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="View/css/style.css">
 </head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Cadastrar Novo Funcionário (Admin)</h2>
    </div>
    <p>Este formulário cadastra um novo usuário com privilégios de Administrador.</p>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'erro_senha'): ?>
            <p style="color: red; border: 1px solid red; padding: 10px;">Erro: As senhas não conferem. Tente novamente.</p>
        <?php elseif ($_GET['status'] == 'erro_cadastro'): ?>
            <p style="color: red; border: 1px solid red; padding: 10px;">Erro: O e-mail ou CPF/CNPJ já pode estar em uso.</p>
        <?php endif; ?>
    <?php endif; ?>
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
            <label>CPF:</label>
            <input type="text" name="cpf_cnpj_usuario" required>
        </div>

        <div>
            <label>Senha Provisória:</label>
            <input type="password" name="senha_usuario" required>
        </div>

        <div>
            <label>Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" required>
        </div>


        

        <div>
            <button type="submit" name="acao_cadastrar_funcionario">
                Cadastrar Funcionário
            </button>
        </div>

        <div>
            <a href="?pagina=listar_usuarios" style="display: inline-block; padding: 8px 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">
                &larr; Voltar para a Lista
            </a>
        </div>
    </form>
</main>
</body>
</html>