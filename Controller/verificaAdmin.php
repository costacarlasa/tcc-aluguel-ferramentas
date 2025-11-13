<?php
    //Checa se a sessão existe (id_usuario) E se o tipo é 'administrador'
    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'administrador') {
        session_unset();
        session_destroy(); //Se não for, destrói a sessão por segurança

        //Redireciona para o login
        header("Location: index.php?pagina=login&status=acesso_negado");     
        exit; 
    }
    //Se o script chegou até aqui, o usuário é um admin válido.
?>