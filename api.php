<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'functions.php'; // načte všechny funkce
require_once 'database.php'; // připojí databázi	

header('Content-Type: application/json');



$data = [
    'hostname' => getHostname(),
    'uptime' => getUptime(),
    'usersLogedIn' => getLoggedInUsersCount(),
    'memory' => getMemory(),
    'disk' => getDisk(),
];

echo json_encode($data, JSON_PRETTY_PRINT);

// Vložení do databáze
$stmt = $pdo->prepare("INSERT INTO system_info (
    hostname, uptime, users_logged_in,
    memory_total, memory_used, memory_free,
    disk_size, disk_used, disk_available, disk_usage_percent
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([
    $data['hostname'],
    $data['uptime'],
    $data['usersLogedIn'],
    $data['memory']['total_MB'],
    $data['memory']['used_MB'],
    $data['memory']['free_MB'],
    $data['disk']['size'],
    $data['disk']['used'],
    $data['disk']['available'],
    $data['disk']['usage_percent']
]);