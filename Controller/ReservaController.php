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
        $ferramenta = $ferramentaModel->buscarFerramentaPorId($idFerramenta);

        if ($ferramenta) {
            require_once __DIR__ . '/../View/reserva_formulario.php';
        } else {
            header("Location: index.php?pagina=acessoCliente&status=nao_encontrado");
            exit;
        }
    }

    public function simularReserva() {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'cliente') {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }

        $idFerramenta = $_POST['id_ferramenta'];
        $dataReserva = $_POST['data_reserva'];
        $dataDevolucao = $_POST['data_devolucao'];

        $reservaModel = new Reserva();
        $disponivel = $reservaModel->verificarDisponibilidade($idFerramenta, $dataReserva, $dataDevolucao);

        if (!$disponivel) {
            header("Location: index.php?pagina=reservar_ferramenta&id=$idFerramenta&status=data_indisponivel");
            exit;
        }

        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarFerramentaPorId($idFerramenta);

        $dataInicio = new DateTime($dataReserva);
        $dataFim = new DateTime($dataDevolucao);
        $intervalo = $dataInicio->diff($dataFim);
        $totalDias = $intervalo->days + 1; 

        $valorDiaria = $ferramenta['precoFerramenta'];
        $valorTotal = $valorDiaria * $totalDias;

        $_SESSION['reserva_simulacao'] = [
            'id_usuario' => $_SESSION['id_usuario'],
            'id_ferramenta' => $idFerramenta,
            'data_reserva' => $dataReserva,
            'data_devolucao' => $dataDevolucao,
            'ferramenta_nome' => $ferramenta['nomeFerramenta'],
            'valor_diaria' => $valorDiaria,
            'total_dias' => $totalDias,
            'valor_total' => $valorTotal
        ];        
        header("Location: index.php?pagina=confirmar_reserva");
        exit;
    }

    
    public function processarCadastroReserva() {
        if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['reserva_simulacao'])) {
            header("Location: index.php?pagina=login&status=faca_login");
            exit;
        }
        $dadosSimulacao = $_SESSION['reserva_simulacao'];

        $reserva = new Reserva();
        $reserva->setIdUsuario($dadosSimulacao['id_usuario']);
        $reserva->setIdFerramenta($dadosSimulacao['id_ferramenta']);
        $reserva->setDataReserva($dadosSimulacao['data_reserva']);
        $reserva->setDataDevolucao($dadosSimulacao['data_devolucao']);
        $reserva->setValorReserva($dadosSimulacao['valor_total']); 

        $sucesso = $reserva->criarReserva(); 

        unset($_SESSION['reserva_simulacao']);

        if ($sucesso) {
            header("Location: index.php?pagina=feedback_reserva&status=sucesso");
        } else {
            header("Location: index.php?pagina=feedback_reserva&status=erro_geral");
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