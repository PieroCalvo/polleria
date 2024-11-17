<?php
include 'db.php';

// Obtener el ID de la bebida desde la URL
$id = $_GET['id'];

// Obtener la imagen asociada a la bebida para eliminarla
$query = "SELECT imagen FROM Bebidas WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Eliminar el registro de la bebida
$query_delete = "DELETE FROM Bebidas WHERE id = $id";
if ($conn->query($query_delete) === TRUE) {
    // Verificar si existe la imagen y eliminarla
    $image_path = 'imagenes/' . $row['imagen'];
    if (file_exists($image_path)) {
        unlink($image_path);  // Eliminar la imagen del servidor
    }
    echo "Bebida eliminada correctamente";
} else {
    echo "Error al eliminar la bebida: " . $conn->error;
}

// Redirigir a la página de gestión de bebidas
header("Location: bebidas.php");
?>