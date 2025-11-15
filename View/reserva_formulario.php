<?php
require_once __DIR__ . '/../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Simular Reserva</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> 
</head>
<body>

<?php 
    require_once __DIR__ . '/../_partials/menu_cliente.php'; 
?>

<main>
    <p>Você está reservando a ferramenta:</p>

    <div class="ferramenta-card" style="width: 300px;">
        <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
            <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>">
        <?php endif; ?>
        <h4><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></h4>
        <p>Preço: R$ <?= number_format($ferramenta['precoFerramenta'], 2, ',', '.') ?> / dia</p>
    </div>

    <hr>

    <form action="index.php" method="POST">
        <h3>Selecione o Período:</h3>
        
        <div>
            <label for="data_reserva">Data de Retirada:</label>
            <input type="date" id="data_reserva" name="data_reserva" required>
        </div>
        
        <div>
            <label for="data_devolucao">Data de Devolução:</label>
            <input type="date" id="data_devolucao" name="data_devolucao" required>
        </div>

        <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($ferramenta['idFerramenta']) ?>">
        
        <a href="?pagina=detalhe_ferramenta&id=<?= $ferramenta['idFerramenta'] ?>" style="display: inline-block; padding: 8px 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">
            &larr; Voltar para Detalhes
        </a>

        <button type="submit" name="acao_simular_reserva">Próximo</button>

    </form>
    
</main>

</body>
</html>