<?php

require_once __DIR__ . '/../Model/Reserva.php';
require_once __DIR__ . '/../Model/Ferramenta.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class ReservaController {

    // ==========================================================
    // MÉTODOS DE ADMIN 
    // ==========================================================

    /** Busca os dados no Model e "alimenta" a View de admin. */
    public function listarReservas() {
        $reservaModel = new Reserva();
        $reservas = $reservaModel->listarTodasReservas(); //

        require_once __DIR__ . '/../View/admin/listar_reservas.php';
    }

    /**Busca 1 reserva e "alimenta" o formulário de edição do admin.*/
    public function exibirFormularioEdicao() {
        $id = $_GET['id'] ?? 0;

        $reservaModel = new Reserva();
        $reserva = $reservaModel->buscarPorId($id);

        if ($reserva) {
            // (Esta View 'editar_reserva.php' precisa ser criada/corrigida)
            require_once __DIR__ . '/../View/admin/editar_reserva.php';
        } else {
            header("Location: index.php?pagina=listar_reservas&status=nao_encontrado");
            exit;
        }
    }

    /** Busca 1 reserva e "alimenta" o formulário de exclusão do admin. */
    public function exibirConfirmacaoExclusao() {
        $id = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $reserva = $reservaModel->buscarPorId($id);

        if ($reserva) {
            // (Esta View 'excluir_reserva.php' precisa ser criada/corrigida)
            require_once __DIR__ . '/../View/admin/excluir_reserva.php';
        } else {
            header("Location: index.php?pagina=listar_reservas&status=nao_encontrado");
            exit;
        }
    }


    /**Pega os dados do formulário de admin e manda para o Model.*/
    public function processarEdicao() {
        $reserva = new Reserva();

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

    /** Mostra ao cliente o formulário para escolher as datas.*/
    public function exibirFormularioReserva() {
        $idFerramenta = $_GET['id'] ?? 0;

        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarPorId($idFerramenta);

        if ($ferramenta) {
            require_once __DIR__ . '/../View/reserva_formulario.php';
        } else {
            header("Location: index.php?pagina=vitrine&status=nao_encontrado");
            exit;
        }
    }

    /**Pega os dados do formulário do cliente e cria a reserva.*/
    public function processarCadastroReserva() {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }

        $idFerramenta = $_POST['id_ferramenta']; 
        $dataReserva = $_POST['data_reserva'];
        $dataDevolucao = $_POST['data_devolucao'];
        $idUsuario = $_SESSION['id_usuario'];

        // 3. Busca o preço da ferramenta
        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarPorId($idFerramenta);
        $valorReserva = $ferramenta['precoFerramenta']; // (Aqui podemos calcular o total de dias)

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
}
?>