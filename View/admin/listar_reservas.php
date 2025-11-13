<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reservas - Painel Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>
<main>
    <h1>Gerenciar Reservas</h1>
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
                    <td><?= htmlspecialchars($r['dataReserva']) ?> a <?= htmlspecialchars($r['dataDevolucaoReserva']) ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusReserva'])) ?></td>
                    <td>R$ <?= number_format($r['valorReserva'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusPagamentoReserva'])) ?></td>
                    <td>
                        <a href="editar_reserva.php?id=<?= $r['idReserva'] ?>">Editar</a> |
                        <a href="excluir_reserva.php?id=<?= $r['idReserva'] ?>" 
                            onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</a>
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