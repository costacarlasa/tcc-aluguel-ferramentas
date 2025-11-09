<!DOCTYPE html>
<html lang="pt-br">
<head><title>Cadastro Usuário - Primeiro Acesso</title></head>
<body>
    <?php
    // Lê o status da URL (ex: ?status=cadastro_sucesso)
    $status = $_GET['status'] ?? 'erro';
    
    switch ($status) {
        case 'cadastro_sucesso':
            echo "<h1>Cadastro realizado com sucesso!</h1>";
            echo '<a href="../index.php?pagina=login">Ir para o Login</a>';
            break;
        
        case 'cadastro_erro':
            echo "<h1>Erro ao cadastrar.</h1>";
            echo '<p>O e-mail ou CPF/CNPJ pode já estar em uso.</p>';
            echo '<a href="../index.php?pagina=cadastro">Tentar Novamente</a>';
            break;

        case 'erro_senha':
            echo "<h1>Erro: As senhas não conferem.</h1>";
            echo '<a href="../index.php?pagina=cadastro">Tentar Novamente</a>';
            break;
        
        default:
            echo "<h1>Ocorreu um erro.</h1>";
            echo '<a href="../index.php?pagina=cadastro">Voltar</a>';
    }
    ?>
</body>
</html>