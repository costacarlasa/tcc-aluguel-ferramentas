<?php
session_start();

// Verifica se o usuário é administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}

// Nome do administrador logado
$nomeAdmin = $_SESSION['nome_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<header>
    <h1>Bem-vindo, <?= htmlspecialchars($nomeAdmin) ?>!</h1>
</header>

<nav>
    <ul>
        <li><a href="acessoAdmin.php">Início</a></li>
        <li><a href="formFerramenta.php">Cadastrar Ferramenta</a></li>
        <li><a href="listarFerramentas.php">Listar Ferramentas</a></li>
        <li><a href="reservas.php">Gerenciar Reservas</a></li>
        <li><a href="#">Logout</a></li> 
    </ul>
</nav>

<main>
    <h2>Painel Administrativo</h2>
    <p>Use o menu acima para navegar pelas funções do sistema.</p>
</main>

</body>
</html>
