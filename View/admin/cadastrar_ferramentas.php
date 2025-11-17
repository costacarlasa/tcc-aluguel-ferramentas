<?php 
    require_once __DIR__ . '/../../Controller/verificaAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ferramenta</title>
    <link rel="stylesheet" href="View/css/style.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <div style="text-align: center;">
        <h2 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Cadastrar Nova Ferramenta</h2>
    </div>

    <form action="index.php" method="POST" enctype="multipart/form-data">
    <div>
        <label>Nome:</label>
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
            <label>Valor da Diára (R$):</label>
            <input type="number" name="preco_ferramenta" step="0.01" placeholder="189,90" required>
    </div>

    <div>
        <label>Disponibilidade:</label>        
        <select name="disponibilidade_ferramenta">
            <option value="disponivel">Disponível</option>
            <option value="reservada">Reservada</option>
            <option value="inativa">Inativa</option>
        </select>
    </div>

    <div>
            <label>Foto:</label>
            <input type="file" name="foto_ferramenta">
        </div>

    <button type="submit" name="acao_cadastrar_ferramenta">Cadastrar</button>
    </form>
</main>
</body>
</html>
