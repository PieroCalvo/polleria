<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $tamaño = $_POST['tamaño'];

    // Manejo de la imagen
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($imagen);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validar que la imagen sea JPG
    if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
        die("Solo se permiten archivos JPG.");
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo "<script>alert('La imagen ya existe. Elige otra imagen.');</script>";
        // Redirigir de vuelta al formulario de agregar
        echo "<script>window.location.href='bebidas.php';</script>";
        exit();
    }

    // Mover la imagen a la carpeta 'imagenes'
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Insertar los datos en la base de datos
        $query = "INSERT INTO Bebidas (nombre, precio, tamaño, imagen) VALUES ('$nombre', '$precio', '$tamaño', '$imagen')";
        
        if ($conn->query($query) === TRUE) {
            echo "Nueva bebida agregada correctamente.<br>";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Hubo un error al subir la imagen.";
    }

    // Volver a la gestión de bebidas
    header("Location: bebidas.php");
}
?>