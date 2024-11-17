<?php
include 'db.php';

// Obtener el ID del pollo desde la URL
$id = $_GET['id'];

// Obtener los datos del pollo actual para mostrar en el formulario
$query = "SELECT * FROM Pollos WHERE id = $id";
$result = $conn->query($query);
$pollo = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pollo</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Editar Pollo: <?php echo $pollo['nombre']; ?></h1>
    
    <!-- Formulario para editar el pollo -->
    <form id="polloForm" action="pollos_actualizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $pollo['nombre']; ?>"><br>
        
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" value="<?php echo $pollo['precio']; ?>"><br>
        
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $pollo['descripcion']; ?></textarea><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen del Pollo:</label>
                <div class="drag-area" id="dragArea">
                    Arrastra tu imagen aquí o 
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" onchange="showImagePreview(event)" style="display: none;">
                    <button type="button" class="btn" onclick="document.getElementById('imagen').click();">Seleccionar Imagen</button>
                </div>
                <div class="image-name" id="imageName">Nombre de la imagen: <?php echo $pollo['imagen']; ?></div><br> <!-- Mostrar nombre del archivo -->
            </div>

            <div>
                <label>Vista previa de la imagen:</label>
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" alt="Vista previa de la imagen" src="imagenes/<?php echo $pollo['imagen']; ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Actualizar</button>
    </form>

    <a href="pollos.php" class="btn btn-menu">Volver a la Gestión de Pollos</a>

    <script src="scripts.js"></script> <!-- Vinculamos el archivo scripts.js -->
</body>
</html>
