<?php

require_once __DIR__ . '/UsuarioController.php';

// ROTA 1: FLUXO DE CADASTRO - Verifica se o botão "acao_cadastrar" (do formulário) foi clicado
if (isset($_POST['acao_cadastrar'])) {
    $controller = new UsuarioController();
    $controller->processarCadastro(); 
} 
// ROTA 2: FLUXO DE LOGIN (VIA POST) - Verifica se o botão "acao_login" foi clicado
elseif (isset($_POST['acao_login'])) {
    $controller = new UsuarioController();
    $controller->processarLogin();
} 
// ROTA PADRÃO: NAVEGAÇÃO (VIA GET) - Se nenhum botão foi clicado, o usuário está apenas navegando por links
else {
    $pagina = $_GET['pagina'] ?? 'login';     
    switch ($pagina) {     // Carrega a View (página HTML) correspondente
        case 'login':
            include_once __DIR__ . '/../View/login.php';
            break;
        case 'cadastro':
            include_once __DIR__ . '/../View/cadastroUsuario.php';
            break;
        default:
            include_once __DIR__ . '/../View/login.php';
            break;
    
            case 'painel_admin':
            // Protege a rota — só permite se o usuário for admin
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'administrador') {
                include_once __DIR__ . '/../View/admin/painel.php';
            } else {
                header('Location: index.php?pagina=login&status=acesso_negado');
                exit;
            }
            break;

        default:
            include_once __DIR__ . '/../View/login.php';
            break;
    }
}

