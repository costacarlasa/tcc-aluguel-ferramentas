<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vitrine de Ferramentas</title>
    <link rel="stylesheet" href="View/css/style.css">
    
    </head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Vitrine de Ferramentas
        </h2>
    </div>

    <p>Olá, <?= htmlspecialchars($_SESSION['nome_usuario']) ?>!</p>
    <p>Escolha sua ferramenta.</p>

    <div class="vitrine-container">
        <?php
        if (isset($ferramentas) && !empty($ferramentas)):
            foreach ($ferramentas as $ferramenta):
        ?>
            <div class="ferramenta-card">
                <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
                    <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>">
                <?php else: ?>
                    <img src="Img/Screenshot_1.png" alt="Ferramenta sem foto"> 
                <?php endif; ?>

                <h4><?= htmlspecialchars($ferramenta['nomeFerramenta']) ?></h4>
                <p>R$ <?= number_format($ferramenta['precoFerramenta'], 2, ',', '.') ?> / dia</p>
                
                <a href="?pagina=detalhe_ferramenta&id=<?= $ferramenta['idFerramenta'] ?>">
                    Ver Detalhes
                </a>
            </div>
        <?php
            endforeach;
        else:
        ?>
            <p>Nenhuma ferramenta disponível no momento.</p>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
