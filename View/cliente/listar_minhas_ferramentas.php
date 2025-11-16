<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Ferramentas (Locador)</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> </head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Minhas Ferramentas (Modo Locador)</h2>
    <p>Aqui você gerencia as ferramentas que cadastrou para aluguel.</p>

    <p><a href="?pagina=cadastrar_minha_ferramenta" style="padding: 10px 15px; background-color: green; color: white; text-decoration: none;">+ Cadastrar Nova Ferramenta</a></p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso_cadastro_locador'): ?>
        <p style="color: green; border: 1px solid green; padding: 10px;">Nova ferramenta cadastrada com sucesso!</p>
    <?php elseif (isset($_GET['status']) && str_starts_with($_GET['status'], 'erro_')): ?>
        <p style="color: red; border: 1px solid red; padding: 10px;">Ocorreu um erro ao processar a solicitação.</p>
    <?php endif; ?>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Modelo</th>
                <th>Categoria</th>
                <th>Preço/Dia</th>
                <th>Disponibilidade</th>
                <th>Foto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Esta variável $ferramentas virá do Controller (Tarefa 5.3)
            if (isset($ferramentas) && !empty($ferramentas)):
                foreach ($ferramentas as $f):
            ?>
                <tr>
                    <td><?= htmlspecialchars($f['nomeFerramenta']) ?></td>
                    <td><?= htmlspecialchars($f['modeloFerramenta']) ?></td>
                    <td><?= htmlspecialchars($f['categoriaFerramenta']) ?></td>
                    <td>R$ <?= number_format($f['precoFerramenta'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($f['disponibilidadeFerramenta']) ?></td>
                    <td>
                        <?php if (!empty($f['fotoFerramenta'])): ?>
                            <img src="Img/<?= htmlspecialchars($f['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($f['nomeFerramenta']) ?>" width="100">
                        <?php else: ?>
                            Sem Foto
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?pagina=editar_minha_ferramenta&id=<?= $f['idFerramenta'] ?>">Editar</a> |
                        <a href="?pagina=excluir_minha_ferramenta&id=<?= $f['idFerramenta'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="5">Você ainda não cadastrou nenhuma ferramenta.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>