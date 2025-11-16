<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="View/css/style.css">
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <div style="text-align: center;">
    <h2>Editar Usuário (ID: <?= htmlspecialchars($usuario['idUsuario']) ?>)</h2>
    </div>
    <p>Atenção: A senha não pode ser alterada por este formulário.</p>
    
    <form action="index.php" method="POST">
        
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['idUsuario']) ?>">

        <div>
            <label>Nome Completo:</label>
            <input type="text" name="nome_usuario" value="<?= htmlspecialchars($usuario['nomeUsuario']) ?>" required>
        </div>

        <div>
            <label>E-mail:</label>
            <input type="email" name="email_usuario" value="<?= htmlspecialchars($usuario['emailUsuario']) ?>" required>
        </div>
        
        <div>
            <label>Telefone:</label>
            <input type="text" name="telefone_usuario" value="<?= htmlspecialchars($usuario['telefoneUsuario']) ?>">
        </div>

        <div>
            <label>Endereço:</label>
            <input type="text" name="endereco_usuario" value="<?= htmlspecialchars($usuario['enderecoUsuario']) ?>">
        </div>

        <div>
            <label>CPF/CNPJ:</label>
            <input type="text" name="cpf_cnpj_usuario" value="<?= htmlspecialchars($usuario['cpf_cnpjUsuario']) ?>" required>
        </div>
        
        <hr>
        
        <div>
            <label>Tipo de Usuário (Permissão):</label>
            <select name="tipo_usuario">
                <option value="cliente" <?= ($usuario['tipoUsuario'] == 'cliente') ? 'selected' : '' ?>>Cliente</option>
                <option value="administrador" <?= ($usuario['tipoUsuario'] == 'administrador') ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <div>
            <label>Categoria (Cliente):</label>
            <select name="categoria_cliente">
                <option value="PF" <?= ($usuario['categoriaCliente'] == 'PF') ? 'selected' : '' ?>>Pessoa Física (PF)</option>
                <option value="PJ" <?= ($usuario['categoriaCliente'] == 'PJ') ? 'selected' : '' ?>>Pessoa Jurídica (PJ)</option>
            </select>
        </div>
        
        <button type="submit" name="acao_editar_usuario">Salvar Alterações</button>
        <a href="?pagina=listar_usuarios">Cancelar</a>
    </form>
</main>
</body>
</html>