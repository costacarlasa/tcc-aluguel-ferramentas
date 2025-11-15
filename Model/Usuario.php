<?php

require_once __DIR__ . '/Conexao.php';

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
    private $nivelAcessoUsuario; 

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
    public function setnivelAcessoUsuario($nivel) {
        $this->nivelAcessoUsuario = $nivel;
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

    public function getcategoriaCliente() {
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

    public function getnivelAcessoUsuario() {
    return $this->nivelAcessoUsuario;    
    }
    
//MÉTODO CADASTRAR
    public function cadastrar() {
        
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        if (empty($this->tipoUsuario)) {
            $this->tipoUsuario = 'cliente';
        }
        
        $this->nivelAcessoUsuario = ($this->tipoUsuario == 'administrador') ? 'total' : 'basico';
        
        $senhaCriptografada = password_hash($this->senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO usuario (nomeUsuario, 
                                        emailUsuario, 
                                        senhaUsuario, 
                                        tipoUsuario, 
                                        categoriaCliente, 
                                        nivelAcessoUsuario, 
                                        cpf_cnpjUsuario, 
                                        telefoneUsuario, 
                                        enderecoUsuario) 
                    VALUES (:nomeUsuario, 
                            :emailUsuario, 
                            :senhaUsuario, 
                            :tipoUsuario, 
                            :categoriaCliente, 
                            :nivelAcessoUsuario, 
                            :cpf_cnpjUsuario, 
                            :telefoneUsuario, 
                            :enderecoUsuario)";


            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nomeUsuario', $this->nome);
            $stmt->bindParam(':emailUsuario', $this->email);
            $stmt->bindParam(':senhaUsuario', $senhaCriptografada);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->bindParam(':categoriaCliente', $this->categoriaCliente);
            $stmt->bindParam(':nivelAcessoUsuario', $this->nivelAcessoUsuario);
            $stmt->bindParam(':cpf_cnpjUsuario', $this->cpfCnpj);
            $stmt->bindParam(':telefoneUsuario', $this->telefone);
            $stmt->bindParam(':enderecoUsuario', $this->endereco); 
            
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            return false;
        }
    }

// MÉTODO VERIFICAR LOGIN 
    public function verificarLogin($email, $senha) {
        
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "SELECT * FROM usuario WHERE emailUsuario = :emailUsuario LIMIT 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':emailUsuario', $email);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($senha, $usuario['senhaUsuario'])) {
                    return $usuario; 
                } else {
                    return false;
                }

            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo "Erro ao verificar login: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId($id) {
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "SELECT * FROM usuario WHERE idUsuario = :id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário por ID: " . $e->getMessage());
            return false;
        }
    }

    public function atualizarPerfil() {
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "UPDATE usuario SET 
                        nomeUsuario = :nomeUsuario, 
                        telefoneUsuario = :telefoneUsuario, 
                        enderecoUsuario = :enderecoUsuario
                    WHERE idUsuario = :idUsuario";

            $stmt = $pdo->prepare($sql);

            // Usa $this->... (que o Controller vai definir)
            $stmt->bindParam(':nomeUsuario', $this->nome);
            $stmt->bindParam(':telefoneUsuario', $this->telefone);
            $stmt->bindParam(':enderecoUsuario', $this->endereco);
            $stmt->bindParam(':idUsuario', $this->id, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao atualizar perfil: " . $e->getMessage());
            return false;
        }
    }

    public function listarTodosUsuarios() {
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, tipoUsuario, telefoneUsuario 
                    FROM usuario 
                    ORDER BY nomeUsuario ASC";
            
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao listar todos os usuários: " . $e->getMessage());
            return [];
        }
    }

    public function atualizarUsuarioAdmin() {
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "UPDATE usuario SET 
                        nomeUsuario = :nomeUsuario, 
                        emailUsuario = :emailUsuario,
                        telefoneUsuario = :telefoneUsuario, 
                        enderecoUsuario = :enderecoUsuario,
                        tipoUsuario = :tipoUsuario,
                        categoriaCliente = :categoriaCliente,
                        cpf_cnpjUsuario = :cpf_cnpjUsuario
                    WHERE idUsuario = :idUsuario";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nomeUsuario', $this->nome);
            $stmt->bindParam(':emailUsuario', $this->email);
            $stmt->bindParam(':telefoneUsuario', $this->telefone);
            $stmt->bindParam(':enderecoUsuario', $this->endereco);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->bindParam(':categoriaCliente', $this->categoriaCliente);
            $stmt->bindParam(':cpf_cnpjUsuario', $this->cpfCnpj);
            $stmt->bindParam(':idUsuario', $this->id, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário (Admin): " . $e->getMessage());
            return false;
        }
    }

    public function excluirUsuario($id) {
        $conexaoBD = new ConexaoBD(); 
        $pdo = $conexaoBD->conectar();

        try {
            $sql = "DELETE FROM usuario WHERE idUsuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>