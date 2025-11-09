<?php
require_once '../Model/Conexao.php';
require_once '../Model/Ferramenta.php';

$conexaoBD = new ConexaoBD();
$con = $conexaoBD->conectar();

$stmt = $con->prepare("SELECT * FROM ferramentas");
$stmt->execute();
$ferramentas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listar Ferramentas</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <h2>Lista de Ferramentas</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Disponível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody> <?php foreach ($ferramentas as $f): ?> <tr>
                    <td><?= $f['id_ferramenta'] ?></td>
                    <td><?= $f['nome_ferramenta'] ?></td>
                    <td><?= $f['categoria_ferramenta'] ?></td>
                    <td>R$ <?= number_format($f['preco_ferramenta'], 2, ',', '.') ?></td>
                    <td><?= $f['disponibilidade_ferramenta'] ? 'Sim' : 'Não' ?></td>
                    <td> <a href="editar_ferramentas.php?id_ferramenta=<?= $f['id_ferramenta'] ?>">Editar</a> | <a href="excluir_ferramentas.php?id_ferramenta=<?= $f['id_ferramenta'] ?>">Excluir</a> </td>
                </tr> <?php endforeach; ?> </tbody>
    </table>
</body>

</html>