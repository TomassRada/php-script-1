<?php
$host = '172.28.48.1';
$db   = 'pohovor1';
$user = 'root';
$pass = 'admin';
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
    error_log('Chyba DB: ' . $e->getMessage()); // zapíše do logu
    http_response_code(500); // nastaví správný HTTP kód
    echo json_encode(['error' => 'Nelze se připojit k databázi']); // platný JSON
    exit;
}
