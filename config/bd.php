<?php
require '../vendor/autoload.php';

$path = dirname(__FILE__, 2);

$dotenv = Dotenv\Dotenv::createImmutable($path);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Lance a exceção para ser tratada no lugar onde o banco é chamado
    throw new \Exception("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
