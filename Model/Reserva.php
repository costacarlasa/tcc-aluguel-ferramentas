<?php
require_once __DIR__ . '/Conexao.php';

class Reserva {

    public static function listarTodas() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "SELECT r.*, u.nomeUsuario AS nome_usuario, f.nomeFerramenta AS nome_ferramenta
                FROM reserva r
                JOIN usuario u ON r.idUsuario = u.idUsuario
                JOIN ferramenta f ON r.idFerramenta = f.idFerramenta";
                
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarMinhasReservas($idCliente) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "SELECT r.*, f.nomeFerramenta AS nome_ferramenta, 
                        r.dataReserva AS data_inicio, 
                        r.dataDevolucaoReserva AS data_fim, 
                        r.statusReserva AS status_reserva
                FROM reserva r
                JOIN ferramenta f ON r.idFerramenta = f.idFerramenta
                WHERE r.idUsuario = :idCliente
                ORDER BY r.dataReserva DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "SELECT * FROM reserva WHERE idReserva = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function cadastrar($dados) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "INSERT INTO reserva (idUsuario, idFerramenta, dataReserva, dataDevolucaoReserva, statusReserva, statusPagamentoReserva)
                VALUES (:usuario, :ferramenta, :inicio, :fim, :statusReserva, :pagamento)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $dados['idUsuario']);
        $stmt->bindParam(':ferramenta', $dados['idFerramenta']);
        $stmt->bindParam(':inicio', $dados['dataReserva']);
        $stmt->bindParam(':fim', $dados['dataDevolucaoReserva']);
        $stmt->bindParam(':statusReserva', $dados['statusReserva']);
        $stmt->bindParam(':pagamento', $dados['statusPagamentoReserva']);
        $stmt->execute();
    }

    public static function atualizar($dados) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "UPDATE reserva 
                SET idUsuario = :usuario,
                    idFerramenta = :ferramenta,
                    dataReserva = :inicio,
                    dataDevolucaoReserva = :fim,
                    statusReserva = :statusReserva,
                    statusPagamentoReserva = :pagamento
                WHERE idReserva = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $dados['idUsuario']);
        $stmt->bindParam(':ferramenta', $dados['idFerramenta']);
        $stmt->bindParam(':inicio', $dados['dataReserva']);
        $stmt->bindParam(':fim', $dados['dataDevolucaoReserva']);
        $stmt->bindParam(':statusReserva', $dados['statusReserva']);
        $stmt->bindParam(':pagamento', $dados['statusPagamentoReserva']);;
        $stmt->bindParam(':id', $dados['idReserva']);
        $stmt->execute();
    }

    public static function excluir($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "DELETE FROM reserva WHERE idReserva = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>