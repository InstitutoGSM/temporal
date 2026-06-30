<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Por defecto en XAMPP está vacía
$db   = 'panaderia';

$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
