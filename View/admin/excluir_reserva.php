<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <h2>Confirmar Exclusão de Reserva</h2>
    
    <?php if (isset($reserva) && $reserva): ?>

        <p>Tem certeza que deseja excluir permanentemente a reserva (ID: <strong><?= htmlspecialchars($reserva['idReserva']) ?></strong>)?</p>
        <p>Esta ação não pode ser desfeita.</p>

        <form action="index.php" method="POST">
            <input type="hidden" name="id_reserva" value="<?= htmlspecialchars($reserva['idReserva']) ?>">

            <button type="submit" name="acao_excluir_reserva" style="background-color: #dc3545; color: white;">
                Sim, Excluir
            </button>
            <a href="?pagina=listar_reservas">Cancelar</a>
        </form>

    <?php else: ?> <p style="color: red;">Erro: Reserva não encontrada.</p>
        <a href="?pagina=listar_reservas">Voltar para a lista</a>
    <?php endif; ?> </main>
</body>
</html>