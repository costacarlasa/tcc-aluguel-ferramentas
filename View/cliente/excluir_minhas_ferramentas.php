<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Minha Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Confirmar Exclusão</h2>
    
    <?php if (isset($ferramenta) && $ferramenta): ?>

        <p>Tem certeza que deseja excluir permanentemente a sua ferramenta:</p>
        <p><strong><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></strong>?</p>
        
        <p style="color: red; font-weight: bold;">
            Atenção: Esta ação não pode ser desfeita.
            (Se a ferramenta tiver reservas ativas, a exclusão pode falhar).
        </p>

        <form action="index.php" method="POST">
            
            <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($ferramenta['idFerramenta']) ?>">

            <button type="submit" name="acao_excluir_minha_ferramenta" style="background-color: #dc3545; color: white;">
                Sim, Excluir Minha Ferramenta
            </button>
            <a href="?pagina=listar_minhas_ferramentas">Cancelar</a>
        </form>

    <?php else: ?>
        <p style="color: red;">Erro: Ferramenta não encontrada ou você não tem permissão.</p>
        <a href="?pagina=listar_minhas_ferramentas">Voltar</a>
    <?php endif; ?>
</main>
</body>
</html>