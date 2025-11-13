<?php

require_once __DIR__ . '/UsuarioController.php';
require_once __DIR__ . '/FerramentaController.php';
require_once __DIR__ . '/ReservaController.php';

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

// ROTA 3: CADASTRAR FERRAMENTA
elseif (isset($_POST['acao_ferramenta_cadastrar'])) {
    $controller = new FerramentaController();
    $controller->processarCadastro();
}

// ROTA 4: EDITAR FERRAMENTA
elseif (isset($_POST['acao_ferramenta_editar'])) {
    $controller = new FerramentaController();
    $controller->processarEdicao();
}

// ROTA 5: EXCLUIR FERRAMENTA
elseif (isset($_POST['acao_ferramenta_excluir'])) {
    $controller = new FerramentaController();
    $controller->processarExclusao();
}

// ROTA 6: EDITAR RESERVA
elseif (isset($_POST['acao_reserva_editar'])) {
    $controller = new ReservaController();
    $controller->processarEdicao(); // (Vamos supor o nome)
}
// ROTA 7: EXCLUIR RESERVA
elseif (isset($_POST['acao_reserva_excluir'])) {
    $controller = new ReservaController();
    $controller->processarExclusao(); // (Vamos supor o nome)
}

// ROTA PADRÃO: NAVEGAÇÃO (VIA GET) - Se nenhum botão foi clicado, o usuário está apenas navegando por links
else {
    $pagina = $_GET['pagina'] ?? 'login';     
    $controller = null;

    switch ($pagina) { 
        case 'login': //rota de login
            include_once __DIR__ . '/../View/login.php';
            break;

        case 'cadastro': //rota de cadastro cliente
            include_once __DIR__ . '/../View/cadastroUsuario.php';
            break;
        
        case 'logout': //rota para deslogar
            session_unset();
            session_destroy();
            header("Location: index.php?pagina=login&status=logout_sucesso");
            exit;
            break;

        case 'acessoAdmin': //rota painel administrador
            include_once __DIR__ . '/../View/admin/acessoAdmin.php'; 
            break;

        case 'cadastrar_ferramentas': //rota para cadastrar ferramenta
            include_once __DIR__ . '/../View/admin/cadastrar_ferramentas.php';
            break;

        case 'listar_ferramentas': //rota para exibir lista de ferramentas cadastradas no site
            $controller = new FerramentaController();
            $controller->listarFerramentas();
            break;

        case 'listar_reservas': //rota para exibir lista de reservas cadastradas no site
            $controller = new ReservaController();
            $controller->listarReservas();
            break;    

        case 'editar_ferramentas': //rota para fazer alterações no cadastro das ferramentas
            $controller = new FerramentaController();
            $controller->exibirFormularioEdicao(); 
            break;

        case 'editar_reserva': //rota para fazer alterações no cadastro das reservas
            $controller = new ReservaController();
            $controller->exibirFormularioEdicao();
            break;
        
        case 'excluir_ferramentas': //rota para excluir ferramenta
            $controller = new FerramentaController();
            $controller->exibirConfirmacaoExclusao();
            break;   
            
        case 'excluir_reserva': //rota para excluir reserva
            $controller = new ReservaController();
            $controller->exibirConfirmacaoExclusao();
            break;

        // --- Rota Padrão ---
        default:
            include_once __DIR__ . '/../View/login.php';
            break;
    }
}

