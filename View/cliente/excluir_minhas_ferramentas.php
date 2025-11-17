<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Minha Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
    <style>
        .form-container {
            max-width: 650px; 
            margin-top: 100px; 
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main class="form-container">
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
        Confirmar Exclusão</h2>
            
        <?php if (isset($ferramenta) && $ferramenta): ?>

            <p>Tem certeza que deseja excluir permanentemente a sua ferramenta:</p>
            <p><strong><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></strong>?</p>
            
            <div style="text-align: center;">
                <p style="color: red; font-weight: bold;">
                    ATENÇÃO!
                </p>
                
                <p style="color: red; font-weight: bold;">
                     Esta ação não pode ser desfeita. (Se a ferramenta tiver reservas ativas, a exclusão pode falhar) 
                </p>
                
            </div>

            <form action="index.php" method="POST">
                
                <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($ferramenta['idFerramenta']) ?>">

                <div style="text-align: center;">
                    <button type="submit" name="acao_excluir_minha_ferramenta" style="background-color: #dc3545; color: white;">
                        Sim, Excluir Minha Ferramenta
                    </button>
                </div>

                <div style="text-align: center;">
                    <a href="?pagina=listar_minhas_ferramentas">Cancelar</a>
                </div>
            </form>

        <?php else: ?>
            <p style="color: red;">Erro: Ferramenta não encontrada ou você não tem permissão.</p>
            <a href="?pagina=listar_minhas_ferramentas">Voltar</a>
        <?php endif; ?>
    </div>
</main>
</body>
</html>