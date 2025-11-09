<form action="../Controller/FerramentaController.php" method="POST">
    <input type="text" name="nome_ferramenta" placeholder="Nome da ferramenta" required>
    <textarea name="descricao_ferramenta" placeholder="Descrição" required></textarea>
    <input type="text" name="categoria_ferramenta" placeholder="Categoria" required>
    <input type="number" name="preco_ferramenta" step="0.01" placeholder="Preço" required>
    
    <select name="disponibilidade_ferramenta">
        <option value="1">Disponível</option>
        <option value="0">Indisponível</option>
    </select>

    <button type="submit" name="acao_ferramenta_cadastrar">Cadastrar</button>
</form>
