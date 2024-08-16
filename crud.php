<?php
session_start();  // Inicia a sessão
require 'conexao.php';  // Inclui o arquivo de configuração do banco de dados

if (!isset($_SESSION['usuario_id'])) {  // Verifica se o usuário está logado
    header("Location: login.php");  // Redireciona para a página de login se não estiver logado
    exit;
}

// Prepara uma consulta SQL para obter todos os usuários
$stmt = $pdo->query("SELECT * FROM usuario");
$usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtém todos os resultados em um array associativo
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
</head>
<body>
    <h2>Lista</h2>
    <a href="cadastro.php">adicionar</a>  <!-- Link para adicionar novo usuário -->
    <table border="1">  <!-- Tabela para exibir a lista de usuários -->
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Telefone</th>
            <th>Acões</th> 
        </tr>
        <?php foreach ($usuario as $usuario): ?>  <!-- Itera sobre a lista de usuários -->
        <tr>
            <td><?php echo $usuario['id']; ?></td>  <!-- Exibe o ID do usuário -->
            <td><?php echo $usuario['nome']; ?></td>  <!-- Exibe o nome do usuário -->
            <td><?php echo $usuario['email']; ?></td>  <!-- Exibe o email do usuário -->
            <td><?php echo $usuario['senha']; ?></td>  <!-- Exibe o telefone do usuário -->
            <td><?php echo $usuario['telefone']; ?></td>  <!-- Exibe o telefone do usuário -->
            <td>
                <a href="form.php?id=<?php echo $usuario['id']; ?>">Editar</a>  <!-- Link para editar -->
                <a href="crud.php?delete=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>  <!-- Link para excluir -->
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="logout.php">Logout</a>  <!-- Link para logout -->
</body>
</html>

<?php
if (isset($_GET['delete'])) {  // Verifica se a ação é de exclusão
    // Prepara uma consulta SQL para deletar o usuário
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id");
    $stmt->execute(['id' => $_GET['delete']]);  // Executa a exclusão
    header("Location: crud.php");  // Redireciona para a página CRUD após a exclusão
    exit;
}
?>
