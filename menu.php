<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Pollería</title>
    <link rel="stylesheet" href="stylemenu.css">
</head>
<body>
    <h1>Panel de Control - Pollería</h1>
    
    <ul>
        <li><a href="pollos.php">Gestión de Pollos a la Leña</a></li>
        <li><a href="otros_platos.php">Gestión de Otros Platos</a></li>
        <li><a href="bebidas.php">Gestión de Bebidas</a></li>
        <li><a href="locales.php">Gestión de Locales</a></li>
        <!-- Botón de Cerrar Sesión al final, con una clase especial -->
        <li><a href="logout.php" class="logout-btn">Cerrar Sesión</a></li>
    </ul>

</body>
</html>