<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reservas - Painel Admin</title>
    
    <link rel="stylesheet" href="View/css/style.css">

</head>
<body>
<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main style="max-width: none; width: 95%;">

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'sucesso_edicao'): ?>
            <p style="color: green; border: 1px solid green; padding: 10px;">Reserva atualizada com sucesso!</p>
        <?php elseif ($_GET['status'] == 'sucesso_exclusao'): ?>
            <p style="color: green; border: 1px solid green; padding: 10px;">Reserva excluída com sucesso!</p>
        <?php elseif (str_starts_with($_GET['status'], 'erro_')): ?>
            <p style="color: red; border: 1px solid red; padding: 10px;">Ocorreu um erro ao processar a sua solicitação.</p>
        <?php endif; ?>
    <?php endif; ?>

    <div style="text-align: center;">
        <h2> Gerenciar Reservas </h2>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Ferramenta</th>
                <th>Período Reserva</th>
                <th>Status Reserva</th>
                <th>Valor Reserva</th>
                <th>Status Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($reservas) && !empty($reservas)):
                foreach ($reservas as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['idReserva']) ?></td>
                    <td><?= htmlspecialchars($r['nome_usuario']) ?></td>
                    <td><?= htmlspecialchars($r['nome_ferramenta']) ?></td>
                    <td><?= date('d/m/Y', strtotime($r['dataReserva'])) ?> a <?= date('d/m/Y', strtotime($r['dataDevolucaoReserva'])) ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusReserva'])) ?></td>
                    <td>R$ <?= number_format($r['valorReserva'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusPagamentoReserva'])) ?></td>
                    <td>
                        <a href="?pagina=editar_reserva&id=<?= $r['idReserva'] ?>">Editar</a> |
                        <a href="?pagina=excluir_reserva&id=<?= $r['idReserva'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="8">Nenhuma reserva encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>