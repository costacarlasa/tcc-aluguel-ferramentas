<?php
require_once __DIR__ . '/../Model/Usuario.php';

class UsuarioController {

    public function processarCadastro() {

        if ($_POST['senha_usuario'] !== $_POST['confirmar_senha']) { //validar senha
            header("Location: View/feedbackCadastroUsuario.php?status=erro_senha");
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
            header("Location: View/feedbackCadastroUsuario.php?status=cadastro_sucesso");
            exit;
        } else {
            header("Location: View/feedbackCadastroUsuario.php?status=cadastro_erro");
            exit;
        }
    }

    public function processarLogin() {
        $email = $_POST['email_usuario'];
        $senha = $_POST['senha_usuario'];
        
        $usuarioModel = new Usuario();
        $dadosUsuario = $usuarioModel->verificarLogin($email, $senha);
        if ($dadosUsuario) {
            $_SESSION['id_usuario'] = $dadosUsuario['idUsuario'];
            $_SESSION['nome_usuario'] = $dadosUsuario['nomeUsuario'];
            $_SESSION['tipo_usuario'] = $dadosUsuario['tipoUsuario'];

            if ($dadosUsuario['tipoUsuario'] == 'administrador') {
                header("Location: index.php?pagina=acessoAdmin");
            } else {
                header("Location: index.php?pagina=acessoCliente");
            }
            exit;
        } else {
            header("Location: index.php?pagina=login&status=login_invalido");
            exit; 
        }
    }
}
?>