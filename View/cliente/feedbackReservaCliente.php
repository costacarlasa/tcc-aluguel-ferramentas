<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';

$status = $_GET['status'] ?? 'erro_desconhecido';
$mensagem = '';
$cor = 'red';

switch ($status) {
    case 'sucesso':
        $cor = 'green';
        $mensagem = "Reserva realizada com sucesso!";
        break;
    case 'erro_geral':
        $mensagem = "Erro: A reserva não pôde ser concluída. Tente novamente.";
        break;
    case 'data_indisponivel':
        $mensagem = "Erro: A data selecionada não está mais disponível.";
        break;
    case 'ferramenta_indisponivel':
        $mensagem = "Erro: Esta ferramenta não está mais disponível para reserva.";
        break;
    default:
        $mensagem = "Ocorreu um erro desconhecido.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Feedback da Reserva</title>
    <link rel="stylesheet" href="View/admin/css/admin.css"> 
</head>
<body>
<?php require_once __DIR__ . '/../../_partials/menu_cliente.php'; ?>

<main>
    <div style="padding: 20px; text-align: center;">
        <h2 style="color: <?= $cor ?>;"><?= $mensagem ?></h2>
        <br>
        
        <?php if ($status == 'sucesso'): ?>
            <a href="?pagina=minhas_reservas" style="padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none;">
                Ir para Minhas Reservas
            </a>
        <?php else: ?>
            <a href="?pagina=acessoCliente" style="padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none;">
                Voltar para a Vitrine
            </a>
        <?php endif; ?>
    </div>
</main>
</body>
</html>