<?php
require_once __DIR__ . '/../Model/Ferramenta.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class FerramentaController {
    // ==========================================================
    // MÉTODOS GET (Chamados pelo Navegacao.php para MOSTRAR páginas)
    // ==========================================================
    public function listarFerramentas() {
        $ferramentaModel = new Ferramenta();
        $ferramentas = $ferramentaModel->listarFerramentas();

        require_once __DIR__ . '/../View/admin/listar_ferramentas.php';
    }

    public function exibirFormularioEdicao() {
        $id = $_GET['id'] ?? 0;
        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarFerramentaPorId($id);

        if ($ferramenta) {
            require_once __DIR__ . '/../View/admin/editar_ferramentas.php';
        } else {
            header("Location: ../../index.php?pagina=listar_ferramentas&status=nao_encontrado");
            exit;
        }
    }

    public function exibirConfirmacaoExclusao() {
        $id = $_GET['id'] ?? 0;
        $ferramentaModel = new Ferramenta();
        $ferramenta = $ferramentaModel->buscarFerramentaPorId($id);

        if ($ferramenta) {
            require_once __DIR__ . '/../View/admin/excluir_ferramentas.php';
        } else {
            header("Location: ../../index.php?pagina=listar_ferramentas&status=nao_encontrado");
            exit;
        }
    }

    // =============================================================
    // MÉTODOS POST (Chamados pelo Navegacao.php para PROCESSAR dados)
    // =============================================================

    public function processarCadastro() {
        $ferramenta = new Ferramenta();
        $nomeFoto = $this->processarUploadFoto();

        $ferramenta->setNome($_POST['nome_ferramenta']);
        $ferramenta->setModelo($_POST['modelo_ferramenta']);
        $ferramenta->setCategoria($_POST['categoria_ferramenta']);
        $ferramenta->setPreco($_POST['preco_ferramenta']);
        $ferramenta->setDisponibilidade($_POST['disponibilidade_ferramenta']);
        $ferramenta->setFoto($nomeFoto); 

        $sucesso = $ferramenta->cadastrarFerramenta(); 
        if ($sucesso) {
            header("Location: index.php?pagina=listar_ferramentas&status=sucesso_cadastro");
        } else {
            header("Location: index.php?pagina=cadastrar_ferramenta&status=erro_cadastro");
        }
        exit;
    }

    public function processarEdicao() {
        $ferramenta = new Ferramenta();
        $ferramentaAtual = $ferramenta->buscarFerramentaPorId($_POST['id_ferramenta']);

        $nomeFotoAntiga = $ferramentaAtual['fotoFerramenta'] ?? null;
        $nomeFotoNova = $this->processarUploadFoto();

        $ferramenta->setId($_POST['id_ferramenta']);
        $ferramenta->setNome($_POST['nome_ferramenta']);
        $ferramenta->setModelo($_POST['modelo_ferramenta']);
        $ferramenta->setCategoria($_POST['categoria_ferramenta']);
        $ferramenta->setPreco($_POST['preco_ferramenta']);
        $ferramenta->setDisponibilidade($_POST['disponibilidade_ferramenta']);
        
        $ferramenta->setFoto($nomeFotoNova ?? $nomeFotoAntiga); 

        $sucesso = $ferramenta->atualizarFerramenta(); //

        if ($sucesso) {
            header("Location: index.php?pagina=listar_ferramentas&status=sucesso_edicao");
        } else {
            header("Location: index.php?pagina=listar_ferramentas&status=erro_edicao");
        }
        exit;
    }

    public function processarExclusao() {
        $id = $_POST['id_ferramenta'];
        $ferramentaModel = new Ferramenta();        
       
        $sucesso = $ferramentaModel->excluirFerramenta($id); //

        if ($sucesso) {
            header("Location: ?pagina=listar_ferramentas&status=sucesso_exclusao");
        } else {
            header("Location: ?pagina=listar_ferramentas&status=erro_exclusao");
        }
        exit;
    }

    /**
     * Método auxiliar privado para lidar com upload de arquivos
     */
    private function processarUploadFoto() {
        if (isset($_FILES['foto_ferramenta']) && $_FILES['foto_ferramenta']['error'] == 0) {
            
            $targetDir = __DIR__ . "/../../Img/";
            
            if (!file_exists($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    error_log("Falha ao criar diretório de uploads.");
                    return null; 
                }
            }

            $nomeUnico = uniqid() . '_' . basename($_FILES["foto_ferramenta"]["name"]);
            $targetFile = $targetDir . $nomeUnico;

            if (move_uploaded_file($_FILES["foto_ferramenta"]["tmp_name"], $targetFile)) {
                return $nomeUnico; 
            }
        }
        return null;
    }
}
?>