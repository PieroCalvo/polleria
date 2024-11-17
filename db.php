<?php
$host = 'localhost';  // Servidor de la base de datos
$user = 'root';       // Nombre de usuario de MySQL
$password = '';       // Contraseña de MySQL
$database = 'polleria';  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>