<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vitrine de Ferramentas</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> 
    <style>
        .vitrine-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .ferramenta-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .ferramenta-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        .ferramenta-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Vitrine de Ferramentas</h2>
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
                    <img src="Img/placeholder.png" alt="Sem Foto"> 
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
