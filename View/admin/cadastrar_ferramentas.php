<?php 
    require_once __DIR__ . '/../../Controller/verificaAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ferramenta</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <h2>Cadastrar Nova Ferramenta</h2>
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
            <input type="text" name="categoria_ferramenta" placeholder="Marcenaria" required>
    </div>

    <div>
            <label>Valor da Diára (R$):</label>
            <input type="number" name="preco_ferramenta" step="0.01" placeholder="R$ 189,90" required>
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
