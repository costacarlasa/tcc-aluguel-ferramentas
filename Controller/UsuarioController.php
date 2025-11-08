<?php
require_once '../Model/Usuario.php';

class UsuarioController {

    public function processarCadastro() {

        if ($_POST['senha_usuario'] !== $_POST['confirmar_senha']) { //validar senha
            header("Location: ../View/feedback.php?status=erro_senha");
            exit;
        }


        $usuario = new Usuario();
        $usuario->setNome($_POST['nome_usuario']);
        $usuario->setEmail($_POST['email_usuario']);
        $usuario->setTelefone($_POST['telefone_usuario']);
        $usuario->setEndereco($_POST['endereco_usuario']);
        $usuario->setCategoriaCliente($_POST['categoria_cliente']);
        $usuario->setCpfCnpj($_POST['cpf_cnpj_usuario']);
        $usuario->setSenha($_POST['senha_usuario']);

        $sucesso = $usuario->cadastrar();

        if ($sucesso) {
            header("Location: ../View/feedback.php?status=cadastro_sucesso");
            exit;
        } else {
            header("Location: ../View/feedback.php?status=cadastro_erro");
            exit;
        }
    }

    public function processarLogin() {
        echo "Lógica de login será implementada aqui.";
    }
}
?>