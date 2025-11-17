<?php
require_once __DIR__ . '/../Controller/verificaCliente.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Simular Reserva</title>

    <link rel="stylesheet" href="View/css/style.css"> 
    
    <style>
        .ferramenta-card {
            /* (O style.css já define a aparência do card) */
            /* Vamos apenas centralizá-lo e limitar a largura */
            margin: 20px auto; 
            width: 300px;
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../_partials/menu_cliente.php'; 
?>

<main>
    <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #3498db; border-bottom: none;">
        Simular Reserva
    </h2>
    <p>Você está reservando a ferramenta:</p>

    <div class="ferramenta-card">
        <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
            <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>">
        <?php else: ?>
            <img src="Img/Screenshot_1.png" alt="Ferramenta sem foto">
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
        
        <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
        
            <a href="?pagina=detalhe_ferramenta&id=<?= $ferramenta['idFerramenta'] ?>" class="btn btn-secondary">
                &larr; Voltar
            </a>

            <button type="submit" name="acao_simular_reserva">Próximo</button>
        </div>
    </form>
    
</main>

</body>
</html>