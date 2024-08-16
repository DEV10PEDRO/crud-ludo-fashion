<?php
session_start();  // Inicia a sessão
require 'conexao.php';  //Rota de conexao com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Verifica se o formulário foi enviado
    $email = $_POST['email'];  // Obtém o email do formulário
    $senha = $_POST['senha'];  // Obtém a senha do formulário

    // Prepara uma consulta SQL para buscar o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);  // Executa a consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);  // Obtém os dados do usuário

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];  // Salva o ID do usuário na sessão
        header("Location: crud.php");  // Redireciona para a página CRUD
        exit;
    } else {
        $error = "Credenciais inválidas.";  // Mensagem de erro em caso de falha na autenticação
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css"/>
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
    <section class="login">
        <div class="form-container">
            <h1>Faça seu Login</h1>
        <form method="POST">
            
            <div class="container">
                <label for="email">Digite seu email</label>
                <input type="email" name="email" placeholder="Digite seu email" id="email">
            </div>

            <div class="container">
                <label for="senha">Digite sua senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" id="senha">
                
                <div class="nav-login">
                    <a href="#">Recuperar senha</a>    
                </div>
            </div>
            <button type="submit" id="entrar">Etrar</button>

            <div class="redes-icon">
                <p class="signup">Or Singn Up Using</p>

                <div class="redes">
                    <a href="#"><img src="imgs/google.png" width="30px" alt=""></a>
                    <a href="#"><img src="imgs/facebook.png" width="30px" alt=""></a>
                </div>
                    <a href="cadastro.php">Cadastre-se</a>
                    <a href="#">Precisa de ajuda?</a>
                </div>
            </form>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>       
            </div> 
        
        </div>
    </section>
</body>

</html>