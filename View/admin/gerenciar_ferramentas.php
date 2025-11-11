<?php
session_start();

// Apenas administradores podem acessar
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}

// Conexão com o banco de dados
require_once '../../Model/Conexao.php';

try {
    $conexaoBD = new ConexaoBD();
    $con = $conexaoBD->conectar();

    $stmt = $con->prepare("SELECT * FROM ferramentas ORDER BY id_ferramenta DESC");
    $stmt->execute();
    $ferramentas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $ferramentas = [];
    $erro = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Ferramentas</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<header>
    <h1>Gerenciar Ferramentas</h1>
    <a href="acessoAdmin.php">← Voltar ao Painel</a>
</header>

<main>
    <?php if (isset($erro)): ?>
        <p style="color:red;">Erro ao carregar ferramentas: <?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <a href="formFerramenta.php" class="btn">+ Nova Ferramenta</a>

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
            <?php if (empty($ferramentas)): ?>
                <tr><td colspan="5">Nenhuma ferramenta cadastrada.</td></tr>
            <?php else: ?>
                <?php foreach ($ferramentas as $f): ?>
                    <tr>
                        <td><?= htmlspecialchars($f['nome_ferramenta']) ?></td>
                        <td><?= htmlspecialchars($f['modelo']) ?></td>
                        <td><?= number_format($f['preco_ferramenta'], 2, ',', '.') ?></td>
                        <td><?= $f['disponivel'] ? 'Disponível' : 'Indisponível' ?></td>
                        <td>
                            <a href="formFerramenta.php?id_ferramenta=<?= $f['id_ferramenta'] ?>">Editar</a> |
                            <a href="../../Controller/FerramentaController.php?acao=excluir&id=<?= $f['id_ferramenta'] ?>" onclick="return confirm('Deseja realmente excluir esta ferramenta?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
