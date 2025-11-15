<?php

require_once __DIR__ . '/UsuarioController.php';
require_once __DIR__ . '/FerramentaController.php';
require_once __DIR__ . '/ReservaController.php';

// === ROTAS POST (Formulários) ===

if (isset($_POST['acao_cadastrar'])) {
    $controller = new UsuarioController();
    $controller->processarCadastro(); 
} 
elseif (isset($_POST['acao_login'])) {
    $controller = new UsuarioController();
    $controller->processarLogin();
} 

elseif (isset($_POST['acao_cadastrar_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarCadastro();
}
elseif (isset($_POST['acao_editar_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarEdicao();
}
elseif (isset($_POST['acao_excluir_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarExclusao();
}

elseif (isset($_POST['acao_editar_reserva'])) {
    $controller = new ReservaController();
    $controller->processarEdicao();
}
elseif (isset($_POST['acao_excluir_reserva'])) {
    $controller = new ReservaController();
    $controller->processarExclusao();
}

elseif (isset($_POST['acao_cadastrar_reserva'])) {
    $controller = new ReservaController();
    $controller->processarCadastroReserva();
}

// === ROTAS GET (Links/Páginas) ===
else {
    $pagina = $_GET['pagina'] ?? 'login';     
    $controller = null;

    switch ($pagina) { 
        case 'login':
            include_once __DIR__ . '/../View/login.php';
            break;

        case 'cadastro':
            include_once __DIR__ . '/../View/cadastroUsuario.php';
            break;

        case 'logout':
            session_unset();
            session_destroy();
            header("Location: index.php?pagina=login&status=logout_sucesso");
            exit;
            break;

        case 'acessoAdmin':
            include_once __DIR__ . '/../View/admin/acessoAdmin.php';
            break;

        case 'cadastrar_ferramentas': 
            include_once __DIR__ . '/../View/admin/cadastrar_ferramentas.php';
            break;

        case 'listar_ferramentas':
            $controller = new FerramentaController();
            $controller->listarFerramentas();
            break;

        case 'editar_ferramentas':
            $controller = new FerramentaController();
            $controller->exibirFormularioEdicao(); 
            break;

        case 'excluir_ferramentas':
            $controller = new FerramentaController();
            $controller->exibirConfirmacaoExclusao();
            break;   
        
        case 'listar_reservas':
            $controller = new ReservaController();
            $controller->listarReservas();
            break;

        case 'editar_reserva':
            $controller = new ReservaController();
            $controller->exibirFormularioEdicao();
            break;

        case 'excluir_reserva':
            $controller = new ReservaController();
            $controller->exibirConfirmacaoExclusao();
            break;

        // --- TAREFA 3.4 (Cliente - Sprint 3) ---
        case 'acessoCliente': // Rota para a Vitrine
            $controller = new FerramentaController();
            $controller->listarFerramentasParaVitrine();
            break;

        case 'detalhe_ferramenta': // Rota para os Detalhes
            $controller = new FerramentaController();
            $controller->exibirDetalhes();
            break;

        case 'reservar_ferramenta': // Rota para o Formulário de Datas
            $controller = new ReservaController();
            $controller->exibirFormularioReserva();
            break;
            
        case 'minhas_reservas': // Rota para o Histórico
            $controller = new ReservaController();
            $controller->listarMinhasReservas();
            break;
            
        // --- Rota Padrão ---
        default:
            include_once __DIR__ . '/../View/login.php';
            break;
    }
}
?>

