<?php
require_once __DIR__ . '/../Model/Reserva.php';
require_once __DIR__ . '/../Model/Ferramenta.php';

class ReservaController {

    // ==========================================================
    // MÉTODOS DE ADMIN 
    // ==========================================================

    public function listarReservas() {
        $reservaModel = new Reserva();
        $reservas = $reservaModel->listarTodasReservas(); //
        require_once __DIR__ . '/../View/admin/listar_reservas.php';
    }

    public function exibirFormularioEdicao() {
        $id = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $reserva = $reservaModel->buscarPorId($id);

        if ($reserva) {
            require_once __DIR__ . '/../View/admin/editar_reserva.php';
        } else {
            header("Location: index.php?pagina=listar_reservas&status=nao_encontrado");
            exit;
        }
    }

    public function exibirConfirmacaoExclusao() {
        $id = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $reserva = $reservaModel->buscarPorId($id);

        if ($reserva) {
            require_once __DIR__ . '/../View/admin/excluir_reserva.php';
        } else {
            header("Location: index.php?pagina=listar_reservas&status=nao_encontrado");
            exit;
        }
    }

    public function processarEdicao() {
        $reserva = new Reserva();

        // Seta os dados do formulário (o form deve enviar estes campos)
        $reserva->setId($_POST['id_reserva']);
        $reserva->setIdUsuario($_POST['id_usuario']);
        $reserva->setIdFerramenta($_POST['id_ferramenta']);
        $reserva->setDataReserva($_POST['data_reserva']);
        $reserva->setDataDevolucao($_POST['data_devolucao']);
        $reserva->setStatusReserva($_POST['status_reserva']);
        $reserva->setStatusPagamento($_POST['status_pagamento']);

        $sucesso = $reserva->atualizarReserva(); //

        if ($sucesso) {
            header("Location: index.php?pagina=listar_reservas&status=sucesso_edicao");
        } else {
            header("Location: index.php?pagina=listar_reservas&status=erro_edicao");
        }
        exit;
    }


    public function processarExclusao() {
        $id = $_POST['id_reserva'];
        $reservaModel = new Reserva();
        $sucesso = $reservaModel->excluirReserva($id); //

        if ($sucesso) {
            header("Location: index.php?pagina=listar_reservas&status=sucesso_exclusao");
        } else {
            header("Location: index.php?pagina=listar_reservas&status=erro_exclusao");
        }
        exit;
    }


    // ==========================================================
    // MÉTODOS DO CLIENTE 
    // ==========================================================

    public function exibirFormularioReserva() {
        $idFerramenta = $_GET['id'] ?? 0;
        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarPorId($idFerramenta);

        if ($ferramenta) {
            require_once __DIR__ . '/../View/reserva_formulario.php';
        } else {
            header("Location: index.php?pagina=acessoCliente&status=nao_encontrado");
            exit;
        }
    }

    public function processarCadastroReserva() {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }

        $idFerramenta = $_POST['id_ferramenta']; 
        $dataReserva = $_POST['data_reserva'];
        $dataDevolucao = $_POST['data_devolucao'];
        $idUsuario = $_SESSION['id_usuario'];

        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarPorId($idFerramenta);
        $valorReserva = $ferramenta['precoFerramenta']; 

        $reserva = new Reserva();
        $reserva->setIdUsuario($idUsuario);
        $reserva->setIdFerramenta($idFerramenta);
        $reserva->setDataReserva($dataReserva);
        $reserva->setDataDevolucao($dataDevolucao);
        $reserva->setValorReserva($valorReserva);

        $sucesso = $reserva->criarReserva(); //

        if ($sucesso) {
            header("Location: index.php?pagina=minhas_reservas&status=sucesso_reserva");
        } else {
            header("Location: index.php?pagina=reservar_ferramenta&id=$idFerramenta&status=erro_reserva");
        }
        exit;
    }

    public function listarMinhasReservas() {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }

        $idCliente = $_SESSION['id_usuario'];
        $reservaModel = new Reserva();
        $reservas = $reservaModel->listarMinhasReservas($idCliente); //

        require_once __DIR__ . '/../View/cliente/minhas_reservas.php';
    }
}
?>