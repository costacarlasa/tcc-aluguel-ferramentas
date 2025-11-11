<?php
session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../View/login.php?status=acesso_negado');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
</head>
<body>
    <header>
        <h1>Painel Administrativo</h1>
        <nav>
            <a href="listar_ferramentas.php">Gerenciar Ferramentas</a>
            <a href="../Controller/LogoutController.php">Sair</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Bem-vindo, Administrador!</h2>
            <p>Use o menu acima para gerenciar as ferramentas disponíveis na plataforma.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Plataforma de Ferramentas. TCC-ETEC</p>
    </footer>
</body>
</html>