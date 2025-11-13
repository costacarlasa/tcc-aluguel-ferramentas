<?php
   require_once __DIR__ . '/../../Controller/verificaAdmin.php';
    // Se o script chegou até aqui, o usuário é um admin válido.
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
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['nome_usuario']) ?>!</h1>
</header>
<main>
    <h2>Painel Administrativo</h2>
    <p>Use o menu abaixo para navegar pelas funções do sistema.</p>
</main>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php';
?>



</body>
</html>
