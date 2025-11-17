<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>
    <link rel="stylesheet" href="View/css/style.css">
    <style>
        .form-container {
            max-width: 600px; 
            margin-top: 150px; 
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
            Confirmar Exclusão de Reserva</h2>
   
        <?php if (isset($reserva) && $reserva): ?>

            <p>Tem certeza que deseja excluir permanentemente a reserva (ID: <strong><?= htmlspecialchars($reserva['idReserva']) ?></strong>)?</p>
            <p>Esta ação não pode ser desfeita.</p>

            <form action="index.php" method="POST">
                <input type="hidden" name="id_reserva" value="<?= htmlspecialchars($reserva['idReserva']) ?>">

                <div style="text-align: center;">
                    <button type="submit" name="acao_excluir_reserva" style="background-color: #dc3545; color: white;">
                        Sim, Excluir
                    </button>
                </div>

                <div style="text-align: center;">
                    <a href="?pagina=listar_reservas">Cancelar</a>
                </div>
            </form>

        <?php else: ?> <p style="color: red;">Erro: Reserva não encontrada.</p>
            <a href="?pagina=listar_reservas">Voltar para a lista</a>
        <?php endif; ?> 
    </div>
</main>
</body>
</html>