<?php
// Checa se a sessão existe E se o tipo é 'cliente'
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
    
    // Se não for, destrói a sessão por segurança
    session_unset();
    session_destroy(); 

    // Redireciona para o login
    header("Location: index.php?pagina=login&status=acesso_negado_cliente");     
    exit; 
}
// Se o script chegou até aqui, o usuário é um cliente válido.
?>