<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

$simulacao = $_SESSION['reserva_simulacao'] ?? null;

if (!$simulacao) {
    header("Location: index.php?pagina=acessoCliente&status=erro_simulacao");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Reserva</title>
    <link rel="stylesheet" href="View/css/style.css"> 
</head>
<body>
<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Revise sua Reserva
        </h2>
    </div>
    <p>Por favor, confirme os detalhes da sua reserva antes de finalizar.</p>

    <div>
        <h4>Ferramenta:</h4>
        <p><?= htmlspecialchars($simulacao['ferramenta_nome']) ?></p>
    </div>
<div>
        <h4>Período da Reserva:</h4>
        <p>De: <?= date('d/m/Y', strtotime($simulacao['data_reserva'])) ?> <br>
           Até: <?= date('d/m/Y', strtotime($simulacao['data_devolucao'])) ?></p>
    </div>
    <div>
        <h4>Cálculo do Valor:</h4>
        <p>Valor por dia: R$ <?= number_format($simulacao['valor_diaria'], 2, ',', '.') ?></p>
        <p>Total de dias: <?= htmlspecialchars($simulacao['total_dias']) ?></p>
        <h3 style="color: green;">Valor Total a Pagar: R$ <?= number_format($simulacao['valor_total'], 2, ',', '.') ?></h3>
    </div>

    <hr>

    <div style="display: flex; gap: 20px;">

        <a href="?pagina=reservar_ferramenta&id=<?= $simulacao['id_ferramenta'] ?>" style="padding: 10px; background-color: #ccc; color: black; text-decoration: none;">
            Cancelar Simulação
        </a>

        <form action="index.php" method="POST">
            <button type="submit" name="acao_cadastrar_reserva" style="background-color: green; color: white;">
                Confirmar Reserva
            </button>
        </form>

        
    </div>
</main>
</body>
</html>