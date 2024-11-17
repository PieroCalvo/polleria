<?php
include 'db.php';

// Obtener el ID del pollo desde la URL
$id = $_GET['id'];

// Obtener la imagen asociada al pollo para eliminarla
$query = "SELECT imagen FROM Pollos WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Eliminar el registro del pollo
$query_delete = "DELETE FROM Pollos WHERE id = $id";
if ($conn->query($query_delete) === TRUE) {
    // Verificar si existe la imagen y eliminarla
    $image_path = 'imagenes/' . $row['imagen'];
    if (file_exists($image_path)) {
        unlink($image_path);  // Eliminar la imagen del servidor
    }
    echo "Pollo eliminado correctamente";
} else {
    echo "Error al eliminar el pollo: " . $conn->error;
}

// Redirigir a la página de gestión de pollos
header("Location: pollos.php");
?>