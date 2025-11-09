<?php

class ConexaoBD {
    private $host = 'localhost';
    private $db_name = 'aluguel_ferramentas';
    private $user = 'root';
    private $pass = '';
    private $conexao; 

 //  MÉTODO CONECTAR
    public function conectar() {
        $this->conexao = null;

        try {
            $fonteDados = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8';
            $this->conexao = new PDO($fonteDados, $this->user, $this->pass);
            
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
        } catch(PDOException $e) {
            die('Erro de Conexão: ' . $e->getMessage());
        }

        return $this->conexao;
    }
}
?>