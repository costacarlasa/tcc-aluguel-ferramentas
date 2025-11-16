<?php
require_once __DIR__ . '/Conexao.php';

class Reserva {

    private $idReserva;
    private $idUsuario;
    private $idFerramenta;
    private $dataReserva;
    private $dataDevolucaoReserva;
    private $valorReserva;
    private $statusReserva;
    private $statusPagamentoReserva;

    // Setters
    public function setId($id) {
        $this->idReserva = $id;
    }
    public function setIdUsuario($id) {
        $this->idUsuario = $id;
    }
    public function setIdFerramenta($id) {
        $this->idFerramenta = $id;
    }
    public function setDataReserva($data) {
        $this->dataReserva = $data;
    }
    public function setDataDevolucao($data) {
        $this->dataDevolucaoReserva = $data;
    }
    public function setValorReserva($valor) {
        $this->valorReserva = $valor;
    }
    public function setStatusReserva($status) {
        $this->statusReserva = $status;
    }
    public function setStatusPagamento($status) {
        $this->statusPagamentoReserva = $status;
    }

    // Getters
    public function getId() {
        return $this->idReserva;
    }
    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function getIdFerramenta() {
        return $this->idFerramenta;
    }
    public function getDataReserva() {
        return $this->dataReserva;
    }
    public function getDataDevolucao() {
        return $this->dataDevolucaoReserva;
    }
    public function getValorReserva() {
        return $this->valorReserva;
    }
    public function getStatusReserva() {
        return $this->statusReserva;
    }
    public function getStatusPagamento() {
        return $this->statusPagamentoReserva;
    }

    // Métodos de BD

    public function criarReserva() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $this->statusReserva = 'ativa'; 
            $this->statusPagamentoReserva = 'pendente'; 

            $sql = "INSERT INTO reserva (idUsuario, idFerramenta, dataReserva, dataDevolucaoReserva, valorReserva, statusReserva, statusPagamentoReserva)
                    VALUES (:idUsuario, :idFerramenta, :dataReserva, :dataDevolucao, :valor, :statusReserva, :statusPagamento)";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':idFerramenta', $this->idFerramenta);
            $stmt->bindParam(':dataReserva', $this->dataReserva);
            $stmt->bindParam(':dataDevolucao', $this->dataDevolucaoReserva);
            $stmt->bindParam(':valor', $this->valorReserva);
            $stmt->bindParam(':statusReserva', $this->statusReserva);
            $stmt->bindParam(':statusPagamento', $this->statusPagamentoReserva);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao criar reserva: " . $e->getMessage());
            return false;
        }
    }


     // TAREFA 3.1: MÉTODOS PARA ADMIN

    public function listarTodasReservas() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar(); 
        try {
            $sql = "SELECT r.*, u.nomeUsuario AS nome_usuario, f.nomeFerramenta AS nome_ferramenta
                    FROM reserva r
                    JOIN usuario u ON r.idUsuario = u.idUsuario
                    JOIN ferramenta f ON r.idFerramenta = f.idFerramenta
                    ORDER BY r.dataReserva DESC"; 
                    
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar todas as reservas: " . $e->getMessage());
            return [];
        }
    }


    public function listarMinhasReservas($idCliente) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        try {
            $sql = "SELECT r.*, f.nomeFerramenta AS nome_ferramenta, f.fotoFerramenta
                    FROM reserva r
                    JOIN ferramenta f ON r.idFerramenta = f.idFerramenta
                    WHERE r.idUsuario = :idUsuario
                    ORDER BY r.dataReserva DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao listar minhas reservas: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        try{
            $sql = "SELECT * FROM reserva WHERE idReserva = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar reserva por ID: " . $e->getMessage());
            return null;
        }
    }

    public function atualizarReserva() { 
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        try{
            $sql = "UPDATE reserva 
                    SET idUsuario = :usuario,
                        idFerramenta = :ferramenta,
                        dataReserva = :inicio,
                        dataDevolucaoReserva = :fim,
                        statusReserva = :statusReserva,
                        statusPagamentoReserva = :pagamento
                    WHERE idReserva = :idReserva";

            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':usuario', $this->idUsuario);
            $stmt->bindParam(':ferramenta', $this->idFerramenta);
            $stmt->bindParam(':inicio', $this->dataReserva);
            $stmt->bindParam(':fim', $this->dataDevolucaoReserva);
            $stmt->bindParam(':statusReserva', $this->statusReserva);
            // (Corrigido: sem ';;')
            $stmt->bindParam(':pagamento', $this->statusPagamentoReserva); 
            $stmt->bindParam(':idReserva', $this->idReserva, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar reserva: " . $e->getMessage());
            return false;
        }
    }

    public function excluirReserva($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        try{
            $sql = "DELETE FROM reserva WHERE idReserva = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir reserva: " . $e->getMessage());
            return false;
        }
    }

    public function verificarDisponibilidade($idFerramenta, $dataInicio, $dataFim) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "SELECT COUNT(*) FROM reserva 
                    WHERE idFerramenta = :idFerramenta
                    AND statusReserva = 'ativa' 
                    AND (dataReserva <= :dataFim) 
                    AND (dataDevolucaoReserva >= :dataInicio)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idFerramenta', $idFerramenta, PDO::PARAM_INT);
            $stmt->bindParam(':dataInicio', $dataInicio);
            $stmt->bindParam(':dataFim', $dataFim);
            $stmt->execute();
            
            $conflitos = $stmt->fetchColumn();
            return ($conflitos == 0);

        } catch (PDOException $e) {
            error_log("Erro ao verificar disponibilidade: " + $e->getMessage());
            return false; 
        }
    }
}
?>