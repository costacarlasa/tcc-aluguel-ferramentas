<?php
require_once __DIR__ . '/../../Controller/verificaAdmin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="View/css/style.css"> 
</head>
<body>

<?php 
    require_once __DIR__ . '/../../_partials/menu_gerenciamento_admin.php'; 
?>

<main>
    <div style="text-align: center;">
        <h1 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
        Gerenciar Usuários</h1>
    </div>
    
    <p><a href="?pagina=cadastrar_funcionario" class="btn btn-primary">+ Cadastrar Novo Funcionário</a></p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso_cadastro'): ?>
        <p style="color: green; border: 1px solid green; padding: 10px;">Novo funcionário cadastrado com sucesso!</p>
    <?php elseif (isset($_GET['status']) && str_starts_with($_GET['status'], 'erro_')): ?>
        <p style="color: red; border: 1px solid red; padding: 10px;">Ocorreu um erro ao processar a solicitação.</p>
    <?php endif; ?>

    <hr>

    <h3 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Funcionários (administradores)
        </h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $adminsEncontrados = false;
            if (isset($usuarios) && !empty($usuarios)):
                foreach ($usuarios as $usuario):
                    if ($usuario['tipoUsuario'] == 'administrador'): // Filtro
                        $adminsEncontrados = true;
            ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['idUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nomeUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['emailUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['telefoneUsuario']) ?></td>
                    <td>
                        <a href="?pagina=editar_usuario&id=<?= $usuario['idUsuario'] ?>">Editar</a> |
                        <a href="?pagina=excluir_usuario&id=<?= $usuario['idUsuario'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php
                    endif;
                endforeach;
            endif;
            
            if (!$adminsEncontrados):
            ?>
                <tr>
                    <td colspan="5">Nenhum funcionário (administrador) encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr style="margin-top: 30px;">

    
    <h3 style="background-color: #f9f9f9; padding: 10px; border-left: 5px solid #34495e; border-bottom: none;">
            Clientes
        </h3>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $clientesEncontrados = false;
            if (isset($usuarios) && !empty($usuarios)):
                foreach ($usuarios as $usuario):
                    if ($usuario['tipoUsuario'] == 'cliente'): // Filtro
                        $clientesEncontrados = true;
            ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['idUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nomeUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['emailUsuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['telefoneUsuario']) ?></td>
                    <td>
                        <a href="?pagina=editar_usuario&id=<?= $usuario['idUsuario'] ?>">Editar</a> |
                        <a href="?pagina=excluir_usuario&id=<?= $usuario['idUsuario'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php
                    endif;
                endforeach;
            endif;
            
            if (!$clientesEncontrados):
            ?>
                <tr>
                    <td colspan="5">Nenhum cliente encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>