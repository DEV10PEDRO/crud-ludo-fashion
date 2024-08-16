<?php
session_start();  // Inicia a sessão

// Verifica se a sessão do usuário está ativa
if (isset($_SESSION['usuario_id'])) {
    session_unset();  // Limpa todas as variáveis de sessão
    session_destroy();  // Destroi a sessão atual
}

// Redireciona para a página de login após o logout
header("Location: login.php");
exit;
?>
