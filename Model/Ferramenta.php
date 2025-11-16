<?php
require_once __DIR__ . '/Conexao.php';

class Ferramenta {
    private $idFerramenta;
    private $nomeFerramenta;
    private $modeloFerramenta;
    private $categoriaFerramenta;
    private $precoFerramenta;
    private $disponibilidadeFerramenta;
    private $fotoFerramenta;
    private $idUsuario;

    //Setters 
    public function setId($id) {
        $this->idFerramenta = $id;
    }
    public function setNome($nome) {
        $this->nomeFerramenta = $nome;
    }
    public function setModelo($modelo) {
        $this->modeloFerramenta = $modelo;
    }
    public function setCategoria($cat) {
        $this->categoriaFerramenta = $cat;
    }
    public function setPreco($preco) {
        $this->precoFerramenta = $preco;
    }
    public function setDisponibilidade($disp) {
        $this->disponibilidadeFerramenta = $disp;
    }
    public function setFoto($foto) {
        $this->fotoFerramenta = $foto;
    }

    public function setIdUsuario($id) {
        $this->idUsuario = $id;
    }

    public function cadastrarFerramenta() {

        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "INSERT INTO ferramenta (nomeFerramenta, modeloFerramenta, categoriaFerramenta, precoFerramenta, disponibilidadeFerramenta, fotoFerramenta, idUsuario)
                    VALUES (:nome, :modelo, :categoria, :preco, :disponibilidade, :foto, :idUsuario)";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $this->nomeFerramenta);
            $stmt->bindParam(':modelo', $this->modeloFerramenta);
            $stmt->bindParam(':categoria', $this->categoriaFerramenta);
            $stmt->bindParam(':preco', $this->precoFerramenta);
            $stmt->bindParam(':disponibilidade', $this->disponibilidadeFerramenta);
            $stmt->bindParam(':foto', $this->fotoFerramenta);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao cadastrar ferramenta: " . $e->getMessage());
            return false;
        }
    }
    
    public function atualizarFerramenta() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "UPDATE ferramenta SET 
                        nomeFerramenta = :nome, 
                        modeloFerramenta = :modelo, 
                        categoriaFerramenta = :categoria, 
                        precoFerramenta = :preco, 
                        disponibilidadeFerramenta = :disponibilidade, 
                        fotoFerramenta = :foto
                    WHERE idFerramenta = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $this->nomeFerramenta);
            $stmt->bindParam(':modelo', $this->modeloFerramenta);
            $stmt->bindParam(':categoria', $this->categoriaFerramenta);
            $stmt->bindParam(':preco', $this->precoFerramenta);
            $stmt->bindParam(':disponibilidade', $this->disponibilidadeFerramenta);
            $stmt->bindParam(':foto', $this->fotoFerramenta);
            $stmt->bindParam(':id', $this->idFerramenta, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao atualizar ferramenta: " . $e->getMessage());
            return false;
        }
    }

    public function listarFerramentas() {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "SELECT * FROM ferramenta ORDER BY nomeFerramenta ASC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao listar ferramentas: " . $e->getMessage());
            return [];
        }
    }

    public function buscarFerramentaPorId($id) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "SELECT * FROM ferramenta WHERE idFerramenta = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao buscar ferramenta por ID: " . $e->getMessage());
            return null;
        }
    }

    public function excluirFerramenta($id) {

        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "DELETE FROM ferramenta WHERE idFerramenta = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao excluir ferramenta: " . $e->getMessage());
            return false;
        }
    }

    public function listarMinhasFerramentas($idUsuario) {
        $conexaoBD = new ConexaoBD();
        $pdo = $conexaoBD->conectar();
        
        try {
            $sql = "SELECT * FROM ferramenta 
                    WHERE idUsuario = :idUsuario 
                    ORDER BY nomeFerramenta ASC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao listar 'minhas' ferramentas: " . $e->getMessage());
            return [];
        }
    }
}
?>