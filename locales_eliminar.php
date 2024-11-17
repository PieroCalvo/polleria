<?php
include 'db.php';

// Obtener el ID del local desde la URL
$id = $_GET['id'];

// Obtener la imagen asociada al local para eliminarla
$query = "SELECT imagen FROM Locales WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Eliminar el registro del local
$query_delete = "DELETE FROM Locales WHERE id = $id";
if ($conn->query($query_delete) === TRUE) {
    // Verificar si existe la imagen y eliminarla
    $image_path = 'imagenes/' . $row['imagen'];
    if (file_exists($image_path)) {
        unlink($image_path);  // Eliminar la imagen del servidor
    }
    echo "Local eliminado correctamente";
} else {
    echo "Error al eliminar el local: " . $conn->error;
}

// Redirigir a la página de gestión de locales
header("Location: locales.php");
?>
