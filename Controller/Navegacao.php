<?php
require_once __DIR__ . '/UsuarioController.php';
require_once __DIR__ . '/FerramentaController.php';
require_once __DIR__ . '/ReservaController.php';

// ---------------- ROTEAMENTO POST ----------------

// ROTA 1: CADASTRAR USUÁRIO
if (isset($_POST['acao_cadastrar'])) {
    $controller = new UsuarioController();
    $controller->processarCadastro(); 
} 
// ROTA 2: LOGIN
elseif (isset($_POST['acao_login'])) {
    $controller = new UsuarioController();
    $controller->processarLogin();
} 
// ROTA 3: CADASTRAR FERRAMENTA (CORRETO PELO DICIONÁRIO)
elseif (isset($_POST['acao_cadastrar_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarCadastro();
}
// ROTA 4: EDITAR FERRAMENTA (CORRETO PELO DICIONÁRIO)
elseif (isset($_POST['acao_editar_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarEdicao();
}
// ROTA 5: EXCLUIR FERRAMENTA (CORRETO PELO DICIONÁRIO)
elseif (isset($_POST['acao_excluir_ferramenta'])) {
    $controller = new FerramentaController();
    $controller->processarExclusao();
}
// ROTA 6: EDITAR RESERVA (AINDA NÃO TEM NO DICIONÁRIO, MAS VOCÊ JÁ USA)
elseif (isset($_POST['acao_reserva_editar'])) { 
    $controller = new ReservaController();
    $controller->processarEdicao();
}   
// ROTA 7: CLIENTE REALIZAR RESERVA
elseif (isset($_POST['acao_cliente_reservar'])) {
    $controller = new ReservaController();
    $controller->processarCadastroCliente(); 
}

