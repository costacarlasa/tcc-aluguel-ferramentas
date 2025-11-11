<?php
// Inicia a sessão e verifica se o usuário é administrador
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ../../login.php?status=acesso_negado');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Ferramenta</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f4f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 400px;
    }

    .form-container h2 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    textarea {
      resize: none;
      height: 80px;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      background-color: #2e7d32;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }

    .form-container button:hover {
      background-color: #27632a;
    }

    .back-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .back-link a {
      color: #2e7d32;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2><?php echo isset($ferramenta) ? "Editar Ferramenta" : "Cadastrar Ferramenta"; ?></h2>

    <form action="../../controller/FerramentaController.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="acao" value="<?php echo isset($ferramenta) ? 'atualizar' : 'inserir'; ?>">
      <?php if (isset($ferramenta)): ?>
        <input type="hidden" name="id_ferramenta" value="<?php echo $ferramenta['id_ferramenta']; ?>">
      <?php endif; ?>

      <input type="text" name="nome_ferramenta" placeholder="Nome da Ferramenta" 
             value="<?php echo $ferramenta['nome_ferramenta'] ?? ''; ?>" required>

      <textarea name="descricao_ferramenta" placeholder="Descrição da Ferramenta" required><?php echo $ferramenta['descricao_ferramenta'] ?? ''; ?></textarea>

      <input type="number" name="preco_ferramenta" placeholder="Preço de aluguel (R$)" step="0.01" 
             value="<?php echo $ferramenta['preco_ferramenta'] ?? ''; ?>" required>

      <input type="text" name="categoria_ferramenta" placeholder="Categoria" 
             value="<?php echo $ferramenta['categoria_ferramenta'] ?? ''; ?>">

      <input type="file" name="foto_ferramenta" accept="image/*">

      <?php if (!empty($ferramenta['foto_ferramenta'])): ?>
        <p style="font-size: 13px;">Imagem atual: 
          <img src="../../uploads/<?php echo $ferramenta['foto_ferramenta']; ?>" alt="Ferramenta" width="60">
        </p>
      <?php endif; ?>

      <button type="submit">
        <?php echo isset($ferramenta) ? "Salvar Alterações" : "Cadastrar Ferramenta"; ?>
      </button>
    </form>

    <div class="back-link">
      <a href="listar_ferramentas.php">← Voltar para lista</a>
    </div>
  </div>
</body>
</html>
