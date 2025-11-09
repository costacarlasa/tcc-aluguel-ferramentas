<?php
require_once 'Conexao.php';

class Reserva {

    public static function listarTodas() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "SELECT r.*, u.nomeUsuario AS nome_usuario, f.nome_ferramenta AS nome_ferramenta
                FROM reserva r
                JOIN usuario u ON r.id_usuario = u.idUsuario
                JOIN ferramenta f ON r.id_ferramenta = f.id_ferramenta";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "SELECT * FROM reserva WHERE id_reserva = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function cadastrar($dados) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "INSERT INTO reserva (id_usuario, id_ferramenta, data_inicio, data_fim, status_reserva)
                VALUES (:usuario, :ferramenta, :inicio, :fim, :status)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $dados['id_usuario']);
        $stmt->bindParam(':ferramenta', $dados['id_ferramenta']);
        $stmt->bindParam(':inicio', $dados['data_inicio']);
        $stmt->bindParam(':fim', $dados['data_fim']);
        $stmt->bindParam(':status', $dados['status_reserva']);
        $stmt->execute();
    }

    public static function atualizar($dados) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "UPDATE reserva 
                SET id_usuario = :usuario,
                    id_ferramenta = :ferramenta,
                    data_inicio = :inicio,
                    data_fim = :fim,
                    status_reserva = :status
                WHERE id_reserva = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $dados['id_usuario']);
        $stmt->bindParam(':ferramenta', $dados['id_ferramenta']);
        $stmt->bindParam(':inicio', $dados['data_inicio']);
        $stmt->bindParam(':fim', $dados['data_fim']);
        $stmt->bindParam(':status', $dados['status_reserva']);
        $stmt->bindParam(':id', $dados['id_reserva']);
        $stmt->execute();
    }

    public static function excluir($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        $sql = "DELETE FROM reserva WHERE id_reserva = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
