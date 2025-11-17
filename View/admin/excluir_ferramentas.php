<?php 
    require_once __DIR__ . '/../../Controller/verificaAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
    <style>
        .form-container {
            max-width: 600px; 
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
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Confirmar Exclusão</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="id_ferramenta" value="<?= $ferramenta['idFerramenta'] ?>">
            <p>Tem certeza que deseja excluir <strong><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></strong>?</p>
        
            <button type="submit" name="acao_excluir_ferramenta">Excluir</button>
    </div>

    <div style="text-align: center;">
        <a href="?pagina=listar_ferramentas">Cancelar</a>
    </div>
    </form>
</main>
</body>
</html>
