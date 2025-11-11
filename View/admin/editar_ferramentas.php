<?php
session_start();
// Verifica se o usuário é administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}

//  Conexão e model
require_once '../Model/Conexao.php';
require_once '../Model/Ferramenta.php';

// Verifica se o ID da ferramenta foi passado via GET
if (!isset($_GET['id_ferramenta'])) {
    echo "ID da ferramenta não fornecido!";
    exit;
}

$id_ferramenta = $_GET['id_ferramenta'];

// Conecta e busca os dados da ferramenta
$conexaoBD = new ConexaoBD();
$con = $conexaoBD->conectar();

$stmt = $con->prepare("SELECT * FROM ferramentas WHERE id_ferramenta = :id_ferramenta");
$stmt->bindParam(':id_ferramenta', $id_ferramenta, PDO::PARAM_INT);
$stmt->execute();
$ferramenta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ferramenta) {
    echo "Ferramenta não encontrada!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Ferramenta</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<h2>Editar Ferramenta</h2>

<form action="../Controller/FerramentaController.php" method="POST" enctype="multipart/form-data">
    <!-- ID oculto para identificar a ferramenta no controller -->
    <input type="hidden" name="id_ferramenta" value="<?= $ferramenta['id_ferramenta'] ?>">

    <label>Nome:</label>
    <input type="text" name="nome_ferramenta" value="<?= htmlspecialchars($ferramenta['nome_ferramenta']) ?>" required>

    <label>Descrição:</label>
    <textarea name="descricao_ferramenta" required><?= htmlspecialchars($ferramenta['descricao_ferramenta']) ?></textarea>

    <label>Categoria:</label>
    <input type="text" name="categoria_ferramenta" value="<?= htmlspecialchars($ferramenta['categoria_ferramenta']) ?>" required>

    <label>Preço:</label>
    <input type="number" step="0.01" name="preco_ferramenta" value="<?= $ferramenta['preco_ferramenta'] ?>" required>

    <label>Disponibilidade:</label>
    <select name="disponibilidade_ferramenta">
        <option value="1" <?= $ferramenta['disponibilidade_ferramenta'] ? 'selected' : '' ?>>Disponível</option>
        <option value="0" <?= !$ferramenta['disponibilidade_ferramenta'] ? 'selected' : '' ?>>Indisponível</option>
    </select>

    <label>Foto (opcional):</label>
    <input type="file" name="foto_ferramenta">

    <button type="submit" name="acao_ferramenta_editar">Salvar alterações</button>
</form>

</body>
</html>
