<?php
    require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Ferramentas</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
        <h2>Lista de Ferramentas</h2>
        <p><a href="?pagina=cadastrar_ferramentas">Cadastrar Nova Ferramenta</a></p>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Modelo</th>
                    <th>Categoria</th>
                    <th>Valor da Diária</th>
                    <th>Disponibilidade</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($ferramentas) && !empty($ferramentas)):
                    foreach ($ferramentas as $f):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($f['idFerramenta']) ?></td>
                        <td><?= htmlspecialchars($f['nomeFerramenta']) ?></td>
                        <td><?= htmlspecialchars($f['modeloFerramenta']) ?></td>
                        <td><?= htmlspecialchars($f['categoriaFerramenta']) ?></td>
                        <td>R$ <?= number_format($f['precoFerramenta'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($f['disponibilidadeFerramenta']) ?></td>
                        <td>
                            <?php if (!empty($f['fotoFerramenta'])): ?>
                                <img src="../../uploads/<?= htmlspecialchars($f['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($f['nomeFerramenta']) ?>" width="100">
                            <?php else: ?>
                                Sem Foto
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="?pagina=editar_ferramentas&id=<?= $f['idFerramenta'] ?>">Editar</a> |
                            <a href="?pagina=excluir_ferramentas&id=<?= $f['idFerramenta'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                else:
                ?>
                    <tr>
                        <td colspan="8">Nenhuma ferramenta cadastrada ainda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
