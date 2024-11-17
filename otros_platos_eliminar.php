<?php
include 'db.php';

// Obtener el ID del plato desde la URL
$id = $_GET['id'];

// Obtener la imagen asociada al plato para eliminarla
$query = "SELECT imagen FROM Otros_Platos WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Eliminar el registro del plato
$query_delete = "DELETE FROM Otros_Platos WHERE id = $id";
if ($conn->query($query_delete) === TRUE) {
    // Verificar si existe la imagen y eliminarla
    $image_path = 'imagenes/' . $row['imagen'];
    if (file_exists($image_path)) {
        unlink($image_path);  // Eliminar la imagen del servidor
    }
    echo "Plato eliminado correctamente";
} else {
    echo "Error al eliminar el plato: " . $conn->error;
}

// Redirigir a la página de gestión de platos
header("Location: otros_platos.php");
?>