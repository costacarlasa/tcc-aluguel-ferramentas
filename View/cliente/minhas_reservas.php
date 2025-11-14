<?php
session_start();

// Impede acesso sem login
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipoUsuario'] !== 'cliente') {
    header("Location: index.php?pagina=login");
    exit;
}

require_once __DIR__ . '/../../Model/Reserva.php';

$idCliente = $_SESSION['usuario_id'];
$reservas = Reserva::listarMinhasReservas($idCliente);
?>

<h2>Minhas Reservas</h2>

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
                <td><?= $reserva['idReserva'] ?></td>
                <td><?= $reserva['nome_ferramenta'] ?></td>
                <td><?= date('d/m/Y', strtotime($reserva['data_inicio'])) ?></td>
                <td><?= date('d/m/Y', strtotime($reserva['data_fim'])) ?></td>
                <td><?= ucfirst($reserva['status_reserva']) ?></td>
                <td><?= ucfirst($reserva['statusPagamentoReserva']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php endif; ?>
