<?php
include 'db.php';

// Obtener el ID de la bebida desde la URL
$id = $_GET['id'];

// Obtener los datos de la bebida actual para mostrar en el formulario
$query = "SELECT * FROM Bebidas WHERE id = $id";
$result = $conn->query($query);
$bebida = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bebida</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Editar Bebida: <?php echo $bebida['nombre']; ?></h1>
    
    <!-- Formulario para editar la bebida -->
    <form id="bebidaForm" action="bebidas_actualizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre de la Bebida:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $bebida['nombre']; ?>"><br>
        
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" value="<?php echo $bebida['precio']; ?>"><br>
        
        <label for="tamaño">Tamaño:</label><br>
        <input type="text" id="tamaño" name="tamaño" value="<?php echo $bebida['tamaño']; ?>"><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen de la Bebida:</label>
                <div class="drag-area" id="dragArea
                <div class="drag-area" id="dragArea">
                    Arrastra tu imagen aquí o 
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" onchange="showImagePreview(event)" style="display: none;">
                    <button type="button" class="btn" onclick="document.getElementById('imagen').click();">Seleccionar Imagen</button>
                </div>
                <div class="image-name" id="imageName">Nombre de la imagen: <?php echo $bebida['imagen']; ?></div><br> <!-- Mostrar nombre del archivo -->
            </div>

            <div>
                <label>Vista previa de la imagen:</label>
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" alt="Vista previa de la imagen" src="imagenes/<?php echo $bebida['imagen']; ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Actualizar</button>
    </form>

    <a href="bebidas.php" class="btn btn-menu">Volver a la Gestión de Bebidas</a>

    <script src="scripts_bebidas.js"></script> <!-- Vinculamos el archivo scripts_bebidas.js -->
</body>
</html>
