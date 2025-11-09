<?php
require_once '../../Controller/ReservaController.php';
$reservaController = new ReservaController();
$reservas = $reservaController->listarReservas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reservas - Painel Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header><h1>Gerenciar Reservas</h1></header>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Ferramenta</th>
                <th>Período</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $r): ?>
                <tr>
                    <td><?= $r['id_reserva'] ?></td>
                    <td><?= $r['nome_usuario'] ?></td>
                    <td><?= $r['nome_ferramenta'] ?></td>
                    <td><?= $r['data_inicio'] ?> a <?= $r['data_fim'] ?></td>
                    <td><?= ucfirst($r['status_reserva']) ?></td>
                    <td>
                        <a href="editar_reserva.php?id_reserva=<?= $r['id_reserva'] ?>">Editar</a> |
                        <a href="excluir_reserva.php?id_reserva=<?= $r['id_reserva'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
