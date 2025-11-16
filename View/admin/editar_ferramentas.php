<?php
    require_once __DIR__ . '/../../Controller/verificaAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Ferramenta</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <h2>Editar Ferramenta</h2>

    <form action="index.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($ferramenta['idFerramenta']) ?>">
        <div>
            <label>Nome:</label>
            <input type="text" name="nome_ferramenta" value="<?= htmlspecialchars($ferramenta['nomeFerramenta']) ?>" required>
        </div>

        <div>
            <label>Modelo:</label>
            <input type="text" name="modelo_ferramenta" value="<?= htmlspecialchars($ferramenta['modeloFerramenta']) ?>" >
        </div>

        <div>
            <label>Categoria:</label>
            <select name="categoria_ferramenta" required>
                <option value="">Selecione:</option>
                <?php 
                    $categorias = ['Marcenaria', 'Pintura', 'Hidráulica', 'Alvenaria', 'Outros'];
                    $categoriaAtual = $ferramenta['categoriaFerramenta'];

                    foreach ($categorias as $cat): 
                ?>
                    <option value="<?= $cat ?>" <?= ($categoriaAtual == $cat) ? 'selected' : '' ?>>
                        <?= $cat ?>
                    </option>
                <?php 
                    endforeach; 

                    if (!in_array($categoriaAtual, $categorias) && $categoriaAtual):
                ?>
                    <option value="<?= htmlspecialchars($categoriaAtual) ?>" selected>
                        <?= htmlspecialchars($categoriaAtual) ?> (Outros)
                    </option>
                <?php endif; ?>
            </select>
        </div>

        <div>
            <label>Valor da Diária</label>
            <input type="number" step="0.01" name="preco_ferramenta" value="<?= $ferramenta['precoFerramenta'] ?>" required>
        </div>

        <div>
            <label>Disponibilidade:</label>
                <select name="disponibilidade_ferramenta">
                    <option value="disponivel" <?= ($ferramenta['disponibilidadeFerramenta'] == 'disponivel') ? 'selected' : '' ?>>Disponível</option>
                    <option value="inativa" <?= ($ferramenta['disponibilidadeFerramenta'] == 'inativa') ? 'selected' : '' ?>>Indisponível (Inativa)</option>
                    <option value="reservada" <?= ($ferramenta['disponibilidadeFerramenta'] == 'reservada') ? 'selected' : '' ?>>Reservada</option>
                </select>
        </div>

        <div>
            <label>Foto (opcional):</label>
            <input type="file" name="foto_ferramenta">
            <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
                <p>Foto atual: <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="Foto" width="100"></p>
            <?php endif; ?>
        </div>

        <button type="submit" name="acao_editar_ferramenta">Salvar alterações</button>
    </form>
</main>
</body>
</html>
