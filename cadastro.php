<?php
require 'conexao.php';  // Inclui o arquivo de configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Verifica se o formulário foi enviado
    $nome = $_POST['nome'];  // Obtém o nome do formulário
    $email = $_POST['email'];  // Obtém o email do formulário
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Criptografa a senha
    $telefone = $_POST['telefone']; 

    try {
    // Prepara uma consulta SQL para inserir um novo usuário
    $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)");
    $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha, 'telefone' => $telefone]);  // Executa a consulta
    echo "Cadastrado com sucesso!";
    } catch (PDOException $e) {
    echo"Erro no cadastro".$e->getMessage();

    }

    header("Location: login.php");  // Redireciona para a página de login após o cadastro
    exit;
}
    

    

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
  <header>
    <a href="index.php">LudoFashion</a>
    <form action="" id="form-buscar">
      <input type="search" name="buscar" id="buscar" placeholder="buscar" />
      <button type="submit" id="btn-buscar">
        <img src="imgs/search_icon.png" alt="" width="30px" />
      </button>
    </form>
    <a href="#" class="icon-link">
      <img src="imgs/icon_help.png" alt="" width="40px" />
      cadastre-se</a>
    <a href="#" class="icon-link">
      <img src="imgs/icon_person.png" alt="" width="40px" />
      duvidas</a>
  </header>
    <section class="form-dados">
      <div class="cadastro">
      <h1>Cadastrar-se</h1>
      </div>
      <div class="card-dados">
      <form method="POST">
        <div class="dados">
            <label for="none">Nome:</label>
            <input type="text" name="nome" placeholder="Digite seu nome" id="none">
        </div>

        <div class="dados">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Ddigite seu email" id="email">
        </div>

        <div class="dados">
            <label for="num">CPF:</label>
            <input type="text" name="cpf" placeholder="Numero" id="num">
        </div>

        <div class="dados">
          <label for="data">Data de nascimento:</label>
          <input type="date" name="data" id="data">        
      </div>  

      <div class="dados">
        <label for="num">Numero de telefone:</label>
        <input type="tel" name="telefone" placeholder="Digite seu numero" id="num">
      </div>

          <div class="dados">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Digite sua senha" id="none">
        </div>
      
        <input id="cadastrar"type="submit" value="Salvar">
        
        </form>
        </div>
  </section>
</body>

</html>