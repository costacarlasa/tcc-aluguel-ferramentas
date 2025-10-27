<?php

require_once 'conexao.php';

class Usuario {

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $categoriaCliente;
    private $cpfCnpj;
    private $senha;
    private $tipoUsuario; 

// MÉTODOS SETTER 
    public function setId($id) {
        $this->id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    public function setCategoriaCliente($categoria) {
        $this->categoriaCliente = $categoria;
    }
    public function setCpfCnpj($cpfCnpj) {
        $this->cpfCnpj = $cpfCnpj;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setTipoUsuario($tipoUsuario) {
    $this->tipoUsuario = $tipoUsuario;
    }

    

// MÉTODOS GETTER
    public function getId() {
    return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
    return $this->telefone;
    }

    public function getEndereco() {
    return $this->endereco;
    }

    public function getCategoriaCliente() {
    return $this->categoriaCliente;
    }

    public function getCpfCnpj() {
    return $this->cpfCnpj;
    }

    public function getSenha() {
    return $this->senha;
    }

    public function getTipoUsuario() {
    return $this->tipoUsuario;
    }
    
//MÉTODO CADASTRAR
    public function cadastrar() {
        
        $conexaoBD = new ConexaoBD(); //obter a conexão
        $pdo = $conexaoBD->conectar();

        $this->tipoUsuario = 'cliente'; 
        
//CRIPTOGRAFIA DA SENHA
        $senhaCriptografada = password_hash($this->senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO usuario (nome, email, senha, telefone, endereco, tipo, cpf_cnpj, categoria_cliente) 
                    VALUES (:nome, :email, :senha, :telefone, :endereco, :tipo, :cpf_cnpj, :categoria)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':endereco', $this->endereco);
            $stmt->bindParam(':tipo', $this->tipoUsuario);
            $stmt->bindParam(':cpf_cnpj', $this->cpfCnpj);
            $stmt->bindParam(':categoria', $this->categoriaCliente);
            
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            return false;
        }
    }

}
?>