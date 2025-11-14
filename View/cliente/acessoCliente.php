<?php
session_start();

// Inclui o menu correto
include_once __DIR__ . '/../../partials/menu_cliente.php';

// Controller
require_once __DIR__ . '/../../Controller/FerramentaController.php';

// Instancia o controller
$controller = new FerramentaController();

// Método padrão do controller (ajuste se necessário)
$ferramentas = $controller->listarFerramentas();
?>

<h2 style="text-align:center; margin-top:20px;">Bem-vindo(a), <?php echo $_SESSION['nome_usuario']; ?>!</h2>
<p style="text-align:center;">Veja abaixo as ferramentas disponíveis para reserva.</p>

<div class="grid-ferramentas">
    <?php if (!empty($ferramentas)): ?>
        <?php foreach ($ferramentas as $ferramenta): ?>
            <div class="card-ferramenta">
                <img src="uploads/ferramentas/<?php echo $ferramenta['foto_ferramenta']; ?>" alt="Imagem da ferramenta">

                <h3><?php echo htmlspecialchars($ferramenta['nome_ferramenta']); ?></h3>

                <p><strong>Modelo:</strong> <?php echo htmlspecialchars($ferramenta['modelo_ferramenta']); ?></p>

                <p><strong>Categoria:</strong> <?php echo htmlspecialchars($ferramenta['categoria_ferramenta']); ?></p>

                <p><strong>Preço:</strong> R$ <?php echo number_format($ferramenta['preco_ferramenta'], 2, ',', '.'); ?></p>

                <a href="index.php?pagina=detalhe_ferramenta&id=<?php echo $ferramenta['id_ferramenta']; ?>">
                    🔍 Detalhar
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">Nenhuma ferramenta disponível no momento.</p>
    <?php endif; ?>
</div>

<style>
.grid-ferramentas {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}
.card-ferramenta {
    border: 1px solid #ddd;
    border-radius: 10px;
    width: 250px;
    padding: 15px;
    text-align: center;
    background: #fff;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
}
.card-ferramenta img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
}
.card-ferramenta a {
    display: inline-block;
    margin-top: 10px;
    color: #007bff;
    text-decoration: none;
}
.card-ferramenta a:hover {
    text-decoration: underline;
}
</style>
<?php
// Inclui o rodapé do site
include_once __DIR__ . '/../../partials/footer.php';
?>
