<?php 
    require_once __DIR__ . '/../../Controller/verificaAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <h2>Confirmar Exclusão</h2>
    <form action="index.php" method="POST">
        <input type="hidden" name="id_ferramenta" value="<?= $ferramenta['idFerramenta'] ?>">
        <p>Tem certeza que deseja excluir <strong><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></strong>?</p>
        <div>
            <button type="submit" name="acao_excluir_ferramenta">Excluir</button>
            <a href="?pagina=listar_ferramentas">Cancelar</a>
        </div>
    </form>
</main>
</body>
</html>
