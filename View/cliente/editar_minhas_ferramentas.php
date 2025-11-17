<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Minha Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css"> 
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
        Editar Minha Ferramenta</h2>
    </div>

    <?php if (isset($ferramenta) && $ferramenta): ?>
        <form action="index.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($ferramenta['idFerramenta']) ?>">
            
            <div>
                <label>Nome da Ferramenta:</label>
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
                <label>Valor da Diária (R$):</label>
                <input type="number" step="0.01" name="preco_ferramenta" value="<?= htmlspecialchars($ferramenta['precoFerramenta']) ?>" required>
            </div>

            <div>
                <label>Foto (Opcional - Deixe em branco para manter a atual):</label>
                <input type="file" name="foto_ferramenta">
                <?php if (!empty($ferramenta['fotoFerramenta'])): ?>
                    <p>Foto atual: <img src="Img/<?= htmlspecialchars($ferramenta['fotoFerramenta']) ?>" alt="Foto" width="100"></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" name="acao_editar_minha_ferramenta">
                Salvar Alterações
            </button>
            <a href="?pagina=listar_minhas_ferramentas" style="margin-left: 10px;">Cancelar</a>
        </form>
    <?php else: ?>
        <p style="color: red;">Ferramenta não encontrada ou você não tem permissão para editá-la.</p>
        <a href="?pagina=listar_minhas_ferramentas">Voltar</a>
    <?php endif; ?>
</main>
</body>
</html>