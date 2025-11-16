<?php
require_once __DIR__ . '/../../Controller/verificaCliente.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Minha Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_cliente.php'; 
?>

<main>
    <h2>Cadastrar Nova Ferramenta para Aluguel</h2>
    <p>Preencha os dados da ferramenta que você deseja disponibilizar na plataforma.</p>

    <form action="index.php" method="POST" enctype="multipart/form-data">
    
    <div>
        <label>Nome da Ferramenta:</label>
            <input type="text" name="nome_ferramenta" placeholder="Ex: Furadeira de Impacto Bosch" required>
    </div>

    <div>
        <label>Modelo:</label>
        <input type="text" name="modelo_ferramenta" placeholder="GSB 450 RE">
    </div>

    <div>
        <label>Categoria:</label>
        <select name="categoria_ferramenta" required>
            <option value="">Selecione:</option>
            <option value="Marcenaria">Marcenaria</option>
            <option value="Pintura">Pintura</option>
            <option value="Hidráulica">Hidráulica</option>
            <option value="Alvenaria">Alvenaria</option>
            <option value="Outros">Outros</option>
        </select>
    </div>

    <div>
            <label>Valor da Diária (R$):</label>
            <input type="number" name="preco_ferramenta" step="0.01" placeholder="25,00" required>
    </div>

    <div>
            <label>Foto (Obrigatória):</label>
            <input type="file" name="foto_ferramenta" required>
    </div>

    <button type="submit" name="acao_cadastrar_minha_ferramenta">
        Disponibilizar Ferramenta
    </button>
    <a href="?pagina=listar_minhas_ferramentas" style="margin-left: 10px;">Cancelar</a>
    </form>
</main>
</body>
</html>