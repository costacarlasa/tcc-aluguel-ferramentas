<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico - Minhas Reservas</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>
<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
        Histórico - Minhas Reservas</h2>
    </div>

<?php if (empty($reservas)): ?>
    <p>Você ainda não possui reservas cadastradas.</p>

<?php else: ?>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ferramenta</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Status</th>
            <th>Pagamento</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($reservas as $reserva): ?>
            <tr>
                <td><?= htmlspecialchars($reserva['idReserva']) ?></td>
                <td><?= htmlspecialchars($reserva['nome_ferramenta']) ?></td>
                <td><?= date('d/m/Y', strtotime($reserva['dataReserva'])) ?></td>
                <td><?= date('d/m/Y', strtotime($reserva['dataDevolucaoReserva'])) ?></td>
                <td><?= htmlspecialchars(ucfirst($reserva['statusReserva'])) ?></td>
                <td><?= htmlspecialchars(ucfirst($reserva['statusPagamentoReserva'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php endif; ?>

</main>
</body>
</html>
