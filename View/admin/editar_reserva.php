<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Reserva</title>

    <link rel="stylesheet" href="View/css/style.css"> 

    <style>
        .form-container {
            max-width: 600px; /* Mais estreito que o padrão, mais largo que o login */
            margin-top: 50px; 
        }
    </style>
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main class="form-container">

<div style="text-align: center;">
    <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
        Editar Reserva (ID: <?= htmlspecialchars($reserva['idReserva']) ?>) </h2>
</div>
    
    <p>
        <strong>Cliente:</strong> (ID: <?= htmlspecialchars($reserva['idUsuario']) ?>) <br>
        <strong>Ferramenta:</strong> (ID: <?= htmlspecialchars($reserva['idFerramenta']) ?>)
    </p>

    <form action="index.php" method="POST">
        <input type="hidden" name="id_reserva" value="<?= htmlspecialchars($reserva['idReserva']) ?>">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($reserva['idUsuario']) ?>">
        <input type="hidden" name="id_ferramenta" value="<?= htmlspecialchars($reserva['idFerramenta']) ?>">

        <div>
            <label>Data de Reserva:</label>
            <input type="date" name="data_reserva" value="<?= htmlspecialchars($reserva['dataReserva']) ?>" required>
        </div>
        
        <div>
            <label>Data de Devolução:</label>
            <input type="date" name="data_devolucao" value="<?= htmlspecialchars($reserva['dataDevolucaoReserva']) ?>" required>
        </div>

        <div>
            <label>Status da Reserva:</label>
            <select name="status_reserva">
                <option value="ativa" <?= ($reserva['statusReserva'] == 'ativa') ? 'selected' : '' ?>>Ativa</option>
                <option value="finalizada" <?= ($reserva['statusReserva'] == 'finalizada') ? 'selected' : '' ?>>Finalizada</option>
                <option value="cancelada" <?= ($reserva['statusReserva'] == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
            </select>
        </div>

        <div>
            <label>Status do Pagamento:</label>
            <select name="status_pagamento">
                <option value="pendente" <?= ($reserva['statusPagamentoReserva'] == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                <option value="efetuado" <?= ($reserva['statusPagamentoReserva'] == 'efetuado') ? 'selected' : '' ?>>Efetuado</option>
            </select>
        </div>

        <div style="text-align: center;">
            <button type="submit" name="acao_editar_reserva">Salvar Alterações</button>
        </div>

        <div style="text-align: center;">
            <a href="?pagina=listar_reservas" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</main>
</body>
</html>