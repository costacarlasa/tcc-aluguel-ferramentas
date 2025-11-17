<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
    <style>
        .detalhe-container {
            padding: 20px;
            /* O text-align: center; foi REMOVIDO daqui */
        }
        .detalhe-container img {
            max-width: 400px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            
            /* CORREÇÃO: Centraliza a imagem */
            margin: 0 auto 20px auto; 
            display: block;
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main class="detalhe-container">
          
    <?php if (isset($ferramenta) && $ferramenta): ?>

        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #3498db; border-bottom: none;">
            <?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>
        </h2>
        
        <a href="?pagina=acessoCliente" class="btn btn-secondary" style="margin-bottom: 20px;">
            &larr; Voltar para a Vitrine
        </a>

        <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
            <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>">
        <?php else: ?>
            <img src="Img/Screenshot_1.png" alt="Ferramenta sem foto">
        <?php endif; ?>

        <h3>Descrição</h3>
        <p>Modelo: <?= htmlspecialchars($ferramenta['modeloFerramenta']) ?></p>
        <p>Categoria: <?= htmlspecialchars($ferramenta['categoriaFerramenta']) ?></p>
        <p>Disponibilidade: <?= htmlspecialchars(ucfirst($ferramenta['disponibilidadeFerramenta'])) ?></p>
        
        <p>(Aqui entrariam mais informações, como a descrição detalhada, voltagem, etc., se tivéssemos no banco).</p>

        <h3>Preço</h3>
        <p>R$ <?= number_format($ferramenta['precoFerramenta'], 2, ',', '.') ?> / dia</p>

        <hr>

        <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
            <a href="?pagina=reservar_ferramenta&id=<?= $ferramenta['idFerramenta'] ?>" class="btn btn-primary" style="background-color: #3498db;">
                Adicionar Reserva
            </a>
        </div>

    <?php else: ?>
        <h2>Ferramenta não encontrada</h2>
        <p>A ferramenta que você está tentando ver não foi encontrada.</p>
    <?php endif; ?>

</main>

</body>
</html>