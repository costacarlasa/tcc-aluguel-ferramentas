<?php
// Verifica se o cliente está logado
if (!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] !== 'cliente') {
    header("Location: index.php?pagina=login");
    exit;
}
?>

<nav class="menu-cliente">
    <ul>
        <li><a href="index.php?pagina=vitrine">🏠 Vitrine</a></li>
        <li><a href="index.php?pagina=minhas_reservas">📄 Minhas Reservas</a></li>
        <li><a href="index.php?acao=sair">🚪 Sair</a></li>
    </ul>
</nav>

<style>
.menu-cliente ul {
    list-style: none;
    display: flex;
    gap: 15px;
    padding: 10px;
    background: #f0f0f0;
}
.menu-cliente a {
    text-decoration: none;
    font-weight: bold;
}
</style>
