<?php
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}
?>

<form action="../Controller/FerramentaController.php" method="POST">
    <input type="hidden" name="id_ferramenta" value="<?= $ferramenta['id_ferramenta'] ?>">
    <p>Tem certeza que deseja excluir <strong><?= $ferramenta['nome_ferramenta'] ?></strong>?</p>
    <button type="submit" name="acao_ferramenta_excluir">Excluir</button>
</form>
