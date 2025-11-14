<?php 
session_start(); // OBRIGATÓRIO para acessar $_SESSION

include_once __DIR__ . '/../../_partials/menu_cliente.php';
?>

<?php
require_once __DIR__ . '/../../Controller/FerramentaController.php';

$controller = new FerramentaController();
$ferramentas = $controller->listarFerramentasCliente();
?>

<h2 style="text-align:center; margin-top:20px;">
    Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!
</h2>

<p style="text-align:center;">
    Veja abaixo as ferramentas disponíveis para reserva.
</p>
<h2 style="text-align:center; margin-top:20px;">Bem-vindo(a), <?php echo $_SESSION['nome_usuario']; ?>!</h2>
<p style="text-align:center;">Veja abaixo as ferramentas disponíveis para reserva.</p>

<div style="display:flex; flex-wrap:wrap; justify-content:center; margin-top:30px;">

<?php foreach ($ferramentas as $f): ?>
    <div style="width:300px; margin:15px; padding:20px; border:1px solid #ccc; border-radius:10px;">
        <h3><?php echo $f['nome']; ?></h3>
        <p><?php echo $f['descricao']; ?></p>
        <p><strong>Valor diária:</strong> R$ <?php echo number_format($f['valor_diaria'], 2, ',', '.'); ?></p>

        <!-- FORMULÁRIO DE RESERVA -->
        <form method="POST" action="index.php">
            <input type="hidden" name="acao" value="acao_cliente_reservar">
            <input type="hidden" name="id_ferramenta" value="<?php echo $f['id']; ?>">

            <button type="submit" 
                    style="padding:10px 20px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer;">
                Reservar
            </button>
        </form>
    </div>
<?php endforeach; ?>

</div>