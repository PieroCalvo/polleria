<?php
include 'db.php';

// Obtener el ID del plato desde la URL
$id = $_GET['id'];

// Obtener los datos del plato actual para mostrar en el formulario
$query = "SELECT * FROM Otros_Platos WHERE id = $id";
$result = $conn->query($query);
$plato = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plato</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Editar Plato: <?php echo $plato['nombre']; ?></h1>
    
    <!-- Formulario para editar el plato -->
    <form id="platoForm" action="otros_platos_actualizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $plato['nombre']; ?>"><br>
        
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" value="<?php echo $plato['precio']; ?>"><br>
        
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $plato['descripcion']; ?></textarea><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen del Plato:</label>
                <div class="drag-area" id="dragArea">
                    Arrastra tu imagen aquí o 
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" onchange="showImagePreview(event)" style="display: none;">
                    <button type="button" class="btn" onclick="document.getElementById('imagen').click();">Seleccionar Imagen</button>
                </div>
                <div class="image-name" id="imageName">Nombre de la imagen: <?php echo $plato['imagen']; ?></div><br> <!-- Mostrar nombre del archivo -->
            </div>

            <div>
                <label>Vista previa de la imagen:</label>
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" alt="Vista previa de la imagen" src="imagenes/<?php echo $plato['imagen']; ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Actualizar</button>
    </form>

    <a href="otros_platos.php" class="btn btn-menu">Volver a la Gestión de Platos</a>

    <script src="scripts_otros_platos.js"></script> <!-- Vinculamos el archivo scripts.js -->
</body>
</html>