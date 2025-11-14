<?php
require_once __DIR__ . '/../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Reserva</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> 
</head>
<body>

<?php 
    require_once __DIR__ . '/../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Confirmar Reserva</h2>
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
        
        <button type="submit" name="acao_cadastrar_reserva">Confirmar Reserva</button>
    </form>
    
</main>

</body>
</html>