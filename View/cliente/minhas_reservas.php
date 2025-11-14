<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> 
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Minhas Reservas</h2>
    <p>Olá, <?= htmlspecialchars($_SESSION['nome_usuario']) ?>! Este é o seu histórico de aluguéis.</p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso_reserva'): ?>
        <p style="color: green; border: 1px solid green; padding: 10px;">
            Reserva confirmada com sucesso!
        </p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>Ferramenta</th>
                <th>Foto</th>
                <th>Período da Reserva</th>
                <th>Valor Cobrado</th>
                <th>Status do Pagamento</th>
                <th>Status da Reserva</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($reservas) && !empty($reservas)):
                foreach ($reservas as $r):
            ?>
                <tr>
                    <td><?= htmlspecialchars($r['nome_ferramenta']) ?></td>
                    <td>
                        <?php if (!empty($r['fotoFerramenta'])): ?>
                            <img src="Img/<?= htmlspecialchars($r['fotoFerramenta']) ?>" alt="<?= htmlspecialchars($r['nome_ferramenta']) ?>" width="100">
                        <?php else: ?>
                            Sem Foto
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($r['dataReserva']) ?> a <?= htmlspecialchars($r['dataDevolucaoReserva']) ?></td>
                    <td>R$ <?= number_format($r['valorReserva'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusPagamentoReserva'])) ?></td>
                    <td><?= htmlspecialchars(ucfirst($r['statusReserva'])) ?></td>
                </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="6">Você ainda não fez nenhuma reserva.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>