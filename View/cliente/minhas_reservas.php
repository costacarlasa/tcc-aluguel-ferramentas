<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit;
}

// Inclui o Model de Reserva
require_once __DIR__ . '/../../Model/Reserva.php';

// ID do cliente logado
$idCliente = $_SESSION['id_usuario'];

// Busca as reservas do cliente usando método estático
$reservas = Reserva::listarMinhasReservas($idCliente);

// Inclui o menu do cliente
include_once __DIR__ . '/../../_partials/menu_cliente.php';
?>

<div class="container">
    <h2>Minhas Reservas</h2>

    <?php if (!empty($reservas)) : ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Ferramenta</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reserva['nome_ferramenta']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['data_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['data_fim']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['status_reserva']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Você ainda não possui reservas registradas.</p>
    <?php endif; ?>
</div>

<?php
// Rodapé
include_once __DIR__ . '/../../_partials/footer.php';
?>
<style>
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}