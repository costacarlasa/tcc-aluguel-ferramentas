<?php
   require_once __DIR__ . '/../../Controller/verificaAdmin.php';
    // Se o script chegou até aqui, o usuário é um admin válido.
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<header>
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['nome_usuario']) ?>!</h1>
</header>
<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php';
?>
<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Painel Administrativo</h2>
        <p>Use o menu acima para navegar pelas funções do sistema.</p>
    </div>
</main>





</body>
</html>
