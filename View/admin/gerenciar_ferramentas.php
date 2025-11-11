<?php
session_start();

// Apenas administradores podem acessar
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}

// Exemplo de dados estáticos (substitua depois pelo banco de dados)
//$ferramentas = [
 //   ['id_ferramenta' => 1, 'nome_ferramenta' => 'Furadeira', 'modelo' => 'X200', 'preco' => 150.00, 'disponivel' => true],
  //  ['id_ferramenta' => 2, 'nome_ferramenta' => 'Parafusadeira', 'modelo' => 'P300', 'preco' => 200.00, 'disponivel' => false],
  //  ['id_ferramenta' => 3, 'nome_ferramenta' => 'Serra Circular', 'modelo' => 'S100', 'preco' => 350.00, 'disponivel' => true]
//];/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Ferramentas</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<h2>Gerenciar Ferramentas</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Modelo</th>
            <th>Preço (R$)</th>
            <th>Disponibilidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ferramentas as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['nome_ferramenta']) ?></td>
                <td><?= htmlspecialchars($f['modelo']) ?></td>
                <td><?= number_format($f['preco'], 2, ',', '.') ?></td>
                <td><?= $f['disponivel'] ? 'Disponível' : 'Indisponível' ?></td>
                <td>
                    <a href="formFerramenta.php?id_ferramenta=<?= $f['id_ferramenta'] ?>">Editar</a> |
                    <a href="#" onclick="return confirm('Deseja realmente excluir esta ferramenta?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
