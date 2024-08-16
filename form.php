<?php
session_start();  // Inicia a sessão
require 'conexao.php';  // Inclui o arquivo de configuração do banco de dados

if (!isset($_SESSION['usuario_id'])) {  // Verifica se o usuário está logado
    header("Location: login.php");  // Redireciona para a página de login se não estiver logado
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : null;  // Obtém o ID do usuário, se existir
$nome = '';  // Inicializa a variável de nome
$email = '';  // Inicializa a variável de email

if ($id) {  // Se o ID for fornecido, busca os dados do usuário
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");  // Prepara a consulta SQL para buscar o usuário pelo ID
    $stmt->execute(['id' => $id]);  // Executa a consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);  // Obtém os dados do usuário
    
    if ($usuario) {  // Se o usuário existir, preenche os campos do formulário
        $nome = $usuario['nome'];  // Define o nome para o valor atual do usuário
        $email = $usuario['email'];  // Define o email para o valor atual do usuário
        $telefone = $usuario['telefone'];  // Define o email para o valor atual do usuário
        $senha = $usuario['senha'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Verifica se o formulário foi enviado
    $nome = $_POST['nome'];  // Obtém o nome do formulário
    $email = $_POST['email'];  // Obtém o email do formulário
    $telefone = $_POST['telefone'];  // Obtém o telefone do formulário
    $senha = isset($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;  // Obtém e criptografa a senha, se fornecida

    if ($id) {  // Se for edição de usuário
        // Atualiza os dados do usuário
        $stmt = $pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone" . ($senha ? ", senha = :senha" : "") . " WHERE id = :id");
        $params = ['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'senha' => $senha, "id" => $id];
        if ($senha) {
            $params['senha'] = $senha;  // Adiciona a senha ao array de parâmetros se ela foi definida
        }
        $stmt->execute($params);  // Executa a atualização
    } else {  // Se for um novo cadastro
        // Insere um novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)");
        $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'senha' => $senha]);  // Executa a inserção
    }

    header("Location: crud.php");  // Redireciona para a página CRUD após salvar
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/styles.css" />
</head>
<body>
<header>
      <a href="#">LudoFashion</a>
      <form action="" id="form-buscar">
        <input type="search" name="buscar" id="buscar" placeholder="buscar" />
        <button type="submit" id="btn-buscar">
          <img src="imgs/search_icon.png" alt="" width="30px" />
        </button>
      </form>
      <a href="cadastro.php" class="icon-link">
        <img src="imgs/icon_help.png" alt="" width="40px" />
        cadastre-se</a
      >
      <a href="" class="icon-link">
        <img src="imgs/icon_person.png" alt="" width="40px" />
        duvidas</a
      >
    </header>
    <nav class="nav">
      <a href="#" class="link">Catálogo</a>
      <a href="#" class="link">Sobre a Loja</a>
    </nav>
    
    <form class="content" method="POST">  <!-- Formulário para inserir ou editar usuário -->

    <div class="edit">
    <h2><?php echo $id ? 'Editar' : 'Adicionar'; ?> Registro</h2>

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required><br>  <!-- Campo para o nome -->

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>  <!-- Campo para o email -->

        <label>Telefone:</label>
        <input type="telefone" name="telefone" <?php echo $id ? '' : 'required'; ?>><br>  <!-- Campo para a senha (não obrigatório ao editar) -->

        <label>Senha:</label>
        <input type="password" name="senha" <?php echo $id ? '' : 'required'; ?>><br>  <!-- Campo para a senha (não obrigatório ao editar) -->





        <button type="submit"><?php echo $id ? 'Atualizar' : 'Adicionar'; ?></button>  <!-- Botão para enviar o formulário -->
        </div>
    </form>
    <a href="crud.php">Voltar</a>  <!-- Link para voltar à página CRUD -->
</body>
</html>
