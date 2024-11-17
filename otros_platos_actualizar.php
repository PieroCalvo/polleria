<?php
include 'db.php';

// Obtener el ID del plato desde la URL
$id = $_GET['id'];

// Obtener los datos actuales del plato (incluyendo la imagen antigua)
$query = "SELECT imagen FROM Otros_Platos WHERE id = $id";
$result = $conn->query($query);
$plato_actual = $result->fetch_assoc();
$imagen_antigua = $plato_actual['imagen'];

// Obtener los datos enviados desde el formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

// Manejo de la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    // Ruta donde se guardará la nueva imagen
    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo "<script>alert('La imagen ya existe. Elige otra imagen.');</script>";
        // Redirigir de vuelta al formulario de edición
        echo "<script>window.location.href='otros_platos_editar.php?id=$id';</script>";
        exit();
    }

    // Subir la nueva imagen
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Eliminar la imagen antigua si existe
        if (!empty($imagen_antigua) && file_exists($target_dir . $imagen_antigua)) {
            unlink($target_dir . $imagen_antigua);  // Borrar la imagen antigua
        }

        // Actualizar la base de datos con la nueva imagen
        $query = "UPDATE Otros_Platos SET nombre='$nombre', precio='$precio', descripcion='$descripcion', imagen='" . basename($_FILES["imagen"]["name"]) . "' WHERE id=$id";
    } else {
        echo "Error al subir la imagen.";
        exit();
    }
} else {
    // Si no se subió una nueva imagen, solo actualizar los demás campos
    $query = "UPDATE Otros_Platos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id=$id";
}

// Ejecutar la consulta y redirigir si es exitosa
if ($conn->query($query) === TRUE) {
    // Redirigir a la página de gestión de platos
    header("Location: otros_platos.php");
    exit();
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}
?>
