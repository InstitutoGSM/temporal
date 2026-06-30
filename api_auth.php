<?php
session_start();
include('db.php');
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// Obt usuario actual desde la sesion de PHP
if ($action === 'get_user') {
    echo json_encode(['user' => $_SESSION['user'] ?? null]);
}

// Obt perfil completo
elseif ($action === 'get_perfil') {
    $id = $_GET['id'] ?? null;
    $stmt = $conn->prepare("SELECT * FROM profiles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo json_encode($stmt->get_result()->fetch_assoc());
}

// 3. Cerrar sesion
elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['status' => 'ok']);
}
?>