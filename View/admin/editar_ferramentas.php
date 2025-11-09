<form action="../Controller/FerramentaController.php" method="POST">
    <input type="hidden" name="id_ferramenta" value="<?= $ferramenta['id_ferramenta'] ?>">

    <input type="text" name="nome_ferramenta" value="<?= $ferramenta['nome_ferramenta'] ?>">
    <textarea name="descricao_ferramenta"><?= $ferramenta['descricao_ferramenta'] ?></textarea>
    <input type="text" name="categoria_ferramenta" value="<?= $ferramenta['categoria_ferramenta'] ?>">
    <input type="number" step="0.01" name="preco_ferramenta" value="<?= $ferramenta['preco_ferramenta'] ?>">

    <select name="disponibilidade_ferramenta">
        <option value="1" <?= $ferramenta['disponibilidade_ferramenta'] ? 'selected' : '' ?>>Disponível</option>
        <option value="0" <?= !$ferramenta['disponibilidade_ferramenta'] ? 'selected' : '' ?>>Indisponível</option>
    </select>

    <button type="submit" name="acao_ferramenta_editar">Salvar alterações</button>
</form>
