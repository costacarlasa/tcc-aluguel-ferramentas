<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$categoria = $_POST['categoria'];
$documento = $_POST['documento'];
$senha = $_POST['senha'];

$arquivo = fopen("usuarios.txt", "a");
fwrite($arquivo, "Nome: $nome | Email: $email | Telefone: $telefone | Endereço: $endereco | Categoria: $categoria | Documento: $documento | Senha: $senha\n");
fclose($arquivo);

echo "<h3>Usuário cadastrado com sucesso!</h3>";
echo "<a href='cadastro_usuario.php'>Voltar ao cadastro</a>";
?>
