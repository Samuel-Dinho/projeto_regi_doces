<?php
$servername = "localhost"; // Nome do servidor
$username = "seu_usuario"; // Seu nome de usuário do banco de dados
$password = "sua_senha"; // Sua senha do banco de dados
$dbname = "seu_banco_de_dados"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
