<?php
// Obter variáveis de ambiente ou usar valores padrão
$servername = getenv('DB_HOST') ?: 'db'; // Nome do serviço no docker-compose
$username = getenv('DB_USER') ?: 'wasgba';
$password = getenv('DB_PASSWORD') ?: 'senha123';
$database = getenv('DB_NAME') ?: 'supermercado';

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    // Registra o erro em um log e mostra uma mensagem genérica
    error_log("Erro na conexão com o banco de dados: " . $conn->connect_error);
    die("Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.");
}
?>
