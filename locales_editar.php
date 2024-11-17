<?php
include 'db.php';

// Obtener el ID del local desde la URL
$id = $_GET['id'];

// Obtener los datos del local actual para mostrar en el formulario
$query = "SELECT * FROM Locales WHERE id = $id";
$result = $conn->query($query);
$local = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Local</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Editar Local: <?php echo $local['nombre']; ?></h1>
    
    <!-- Formulario para editar el local -->
    <form id="localForm" action="locales_actualizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Local:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $local['nombre']; ?>"><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $local['direccion']; ?>"><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $local['telefono']; ?>"><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen del Local:</label>
                <div class="drag-area" id="dragArea">
                    Arrastra tu imagen aquí o 
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" onchange="showImagePreview(event)" style="display: none;">
                    <button type="button" class="btn" onclick="document.getElementById('imagen').click();">Seleccionar Imagen</button>
                </div>
                <div class="image-name" id="imageName">Nombre de la imagen: <?php echo $local['imagen']; ?></div><br> <!-- Mostrar nombre del archivo -->
            </div>

            <div>
                <label>Vista previa de la imagen:</label>
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" alt="Vista previa de la imagen" src="imagenes/<?php echo $local['imagen']; ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Actualizar</button>
    </form>

    <a href="locales.php" class="btn btn-menu">Volver a la Gestión de Locales</a>

    <script src="scripts_locales.js"></script> <!-- Vinculamos el archivo scripts_locales.js -->
</body>
</html>
