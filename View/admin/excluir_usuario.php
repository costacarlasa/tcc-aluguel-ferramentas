<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>
    <link rel="stylesheet" href="View/css/style.css"> 
    <style>
        .form-container {
            max-width: 800px; 
            margin-top: 100px; 
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main class="form-container">
    <div style="text-align: center;">
        <h2>Confirmar Exclusão de Usuário</h2>
    </div>

    <?php if (isset($usuario) && $usuario): ?>

        <div style="text-align: center;">
            <p>Tem certeza que deseja excluir permanentemente o usuário:</p>
        </div>

        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nomeUsuario']) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['emailUsuario']) ?></p>
        <p><strong>Tipo:</strong> <?= htmlspecialchars(ucfirst($usuario['tipoUsuario'])) ?></p>
        
        <div style="text-align: center;">
            <p style="color: red; font-weight: bold;">
                Atenção: Esta ação não pode ser desfeita. Se este usuário tiver reservas ativas, a exclusão pode ser bloqueada pelo banco de dados.
            </p>
        </div>

        <form action="index.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['idUsuario']) ?>">

            <div style="text-align: center;">
                <button type="submit" name="acao_excluir_usuario" style="background-color: #dc3545; color: white;">
                    Sim, Excluir Usuário
                </button>
            </div>

            <div style="text-align: center;">
                <a href="?pagina=listar_usuarios">Cancelar</a>
            </div>
        </form>

    <?php else: ?>
        <p style="color: red;">Erro: Usuário não encontrado.</p>
        <a href="?pagina=listar_funcionarios">Voltar para a lista</a>
    <?php endif; ?>
</main>
</body>
</html>