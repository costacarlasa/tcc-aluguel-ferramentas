<?php
require_once __DIR__ . '/../Model/Usuario.php';

class UsuarioController {

    public function processarCadastro() {

        if ($_POST['senha_usuario'] !== $_POST['confirmar_senha']) { 
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

            // SESSÃO
            $_SESSION['id_usuario'] = $dadosUsuario['idUsuario'];
            $_SESSION['nome_usuario'] = $dadosUsuario['nomeUsuario'];
            $_SESSION['tipo_usuario'] = $dadosUsuario['tipoUsuario'];

            // 🔹 ADMIN vai para painel admin
            if ($dadosUsuario['tipoUsuario'] == 'administrador') {
                header("Location: index.php?pagina=acessoAdmin");
                exit;
            }

            // 🔹 CLIENTE vai para a vitrine
            if ($dadosUsuario['tipoUsuario'] == 'cliente') {
                header("Location: index.php?pagina=acessoCliente");
                exit;
            }

            // fallback
            header("Location: index.php");
            exit;

        } else {
            header("Location: index.php?pagina=login&status=login_invalido");
            exit;
        }
    }

    public function exibirMeuPerfil() {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }

        $idUsuario = $_SESSION['id_usuario'];

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($idUsuario);

        if ($usuario) {
            require_once __DIR__ . '/../View/cliente/meu_perfil.php';
        } else {
            header("Location: index.php?pagina=acessoCliente&status=erro_perfil");
            exit;
        }
    }

    public function processarEdicaoPerfil() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php?pagina=login");
            exit;
        }

        $usuario = new Usuario();

        $usuario->setId($_SESSION['id_usuario']);
        $usuario->setNome($_POST['nome_usuario']);
        $usuario->setTelefone($_POST['telefone_usuario']);
        $usuario->setEndereco($_POST['endereco_usuario']);

        $sucesso = $usuario->atualizarPerfil(); //

        if ($sucesso) {
              $_SESSION['nome_usuario'] = $_POST['nome_usuario'];
            header("Location: index.php?pagina=meu_perfil&status=sucesso_edicao");
        } else {
            header("Location: index.php?pagina=meu_perfil&status=erro_edicao");
        }
        exit;
    }
}
?>
