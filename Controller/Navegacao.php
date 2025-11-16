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

elseif (isset($_POST['acao_simular_reserva'])) {
    $controller = new ReservaController();
    $controller->simularReserva();
}

elseif (isset($_POST['acao_cadastrar_reserva'])) {
    $controller = new ReservaController();
    $controller->processarCadastroReserva();
}

elseif (isset($_POST['acao_editar_perfil'])) {
    $controller = new UsuarioController();
    $controller->processarEdicaoPerfil();
}

elseif (isset($_POST['acao_cadastrar_funcionario'])) {
    $controller = new UsuarioController();
    $controller->processarCadastroFuncionario();
}

elseif (isset($_POST['acao_editar_usuario'])) {
    $controller = new UsuarioController();
    $controller->processarEdicaoUsuario();
}

elseif (isset($_POST['acao_excluir_usuario'])) {
    $controller = new UsuarioController();
    $controller->processarExclusaoUsuario();
}

elseif (isset($_POST['acao_cadastrar_minha_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarCadastroMinhaFerramenta();
}

elseif (isset($_POST['acao_editar_minha_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarEdicaoMinhaFerramenta();
}

elseif (isset($_POST['acao_excluir_minha_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarExclusaoMinhaFerramenta();
}


// === ROTAS GET (Links/Páginas) ===
else {
    $pagina = $_GET['pagina'] ?? 'login';     
    $controller = null;

    switch ($pagina) { 
        // --- Públicas ---
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

        // --- Admin ---
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

        case 'listar_usuarios': 
            $controller = new UsuarioController();
            $controller->listarUsuarios(); 
        break;

        case 'cadastrar_funcionario':
            include_once __DIR__ . '/../View/admin/cadastrar_funcionario.php'; 
            break;

        case 'editar_usuario':
            $controller = new UsuarioController();
            $controller->exibirFormularioEdicaoUsuario();
            break;

        case 'excluir_usuario':
            $controller = new UsuarioController();
            $controller->exibirConfirmacaoExclusaoUsuario();
            break;

        // --- Cliente ---
        case 'acessoCliente': 
            $controller = new FerramentaController();
            $controller->listarFerramentasParaVitrine();
            break;

        case 'detalhe_ferramenta': 
            $controller = new FerramentaController();
            $controller->exibirDetalhes();
            break;

        case 'reservar_ferramenta': 
            $controller = new ReservaController();
            $controller->exibirFormularioReserva();
            break;

        case 'minhas_reservas': 
            $controller = new ReservaController();
            $controller->listarMinhasReservas();
            break;

        case 'confirmar_reserva': 
            include_once __DIR__ . '/../View/cliente/confirmarReserva.php';
            break;

        case 'feedback_reserva':
            include_once __DIR__ . '/../View/cliente/feedbackReservaCliente.php';
            break;

        case 'meu_perfil':
            $controller = new UsuarioController();
            $controller->exibirMeuPerfil();
            break;
            
        // --- Cliente Locador ---
        case 'listar_minhas_ferramentas': 
            $controller = new FerramentaController();
            $controller->listarMinhasFerramentas();
            break;

        case 'cadastrar_minha_ferramenta':
            include_once __DIR__ . '/../View/cliente/cadastrar_minhas_ferramentas.php';
            break;

        case 'editar_minha_ferramenta':
            $controller = new FerramentaController();
            $controller->exibirFormularioEdicaoCliente();
            break;
            
        case 'excluir_minha_ferramenta':
            $controller = new FerramentaController();
            $controller->exibirConfirmacaoExclusaoCliente();
            break;
            
        // --- Rota Padrão ---
        default:
            include_once __DIR__ . '/../View/login.php';
            break;
    }
}
?>

