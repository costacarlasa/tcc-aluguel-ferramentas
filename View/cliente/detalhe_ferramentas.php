<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Ferramenta</title>
    <link rel="stylesheet" href="View/admin/css/admin.css">
    <style>
        .detalhe-container {
            padding: 20px;
        }
        .detalhe-container img {
            max-width: 400px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<?php 

    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main class="detalhe-container">
          
    <?php if (isset($ferramenta) && $ferramenta): ?>

        <h2><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></h2>
        <p>Modelo: <?= htmlspecialchars($ferramenta['modeloFerramenta']) ?></p>

        <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
            <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>">
        <?php endif; ?>

        <h3>Descrição</h3>
        <p>Categoria: <?= htmlspecialchars($ferramenta['categoriaFerramenta']) ?></p>
        <p>Disponibilidade: <?= htmlspecialchars(ucfirst($ferramenta['disponibilidadeFerramenta'])) ?></p>
        
        <p>(Aqui entrariam mais informações, como a descrição detalhada, voltagem, etc., se tivéssemos no banco).</p>

        <h3>Preço</h3>
        <p>R$ <?= number_format($ferramenta['precoFerramenta'], 2, ',', '.') ?> / dia</p>


        <a href="?pagina=acessoCliente" style="display: inline-block; padding: 8px 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">
            &larr; Voltar para a Vitrine
        </a>

        <a href="?pagina=reservar_ferramenta&id=<?= $ferramenta['idFerramenta'] ?>" style="padding: 10px 15px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">
            Adicionar Reserva
        </a>

    <?php else: ?>
        <h2>Ferramenta não encontrada</h2>
        <p>A ferramenta que você está tentando ver não foi encontrada.</p>
    <?php endif; ?>

</main>

</body>
</html>