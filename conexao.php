<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'ludo_db';
$username = 'root';
$password = 'admin';

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configura PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se a conexão falhar, exibe mensagem de erro
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
