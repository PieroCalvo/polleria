<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Locales</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Gestión de Locales</h1>

    <!-- Formulario para agregar un nuevo local -->
    <h2>Agregar Nuevo Local</h2>
    <form id="localForm" action="locales_agregar.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Local:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ej: Local Principal - Centro"><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" placeholder="Ej: Calle Principal 123"><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" placeholder="Ej: 0123456789"><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen del Local:</label>
                <div class="drag-area" id="dragArea">
                    Arrastra tu imagen aquí o 
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" onchange="showImagePreview(event)" style="display: none;">
                    <button type="button" class="btn" onclick="document.getElementById('imagen').click();">Seleccionar Imagen</button>
                </div>
                <div class="image-name" id="imageName">Nombre de la imagen: </div><br> <!-- Mostrar nombre del archivo -->
            </div>

            <div>
                <label>Vista previa de la imagen:</label>
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" alt="Vista previa de la imagen">
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Agregar</button>
    </form>

    <h2>Listado de Locales</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            
            <?php
            $query = "SELECT * FROM Locales";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['direccion'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    
                    echo "<td><img src='imagenes/" . $row['imagen'] . "' width='100'></td>";
                    echo "<td><a href='locales_editar.php?id=" . $row['id'] . "' class='btn'>Editar</a> <a href='locales_eliminar.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay locales registrados</td></tr>";
            }
            ?>
        </table>
    </div>
    
    <a href="menu.php" class="btn btn-menu">Volver al Menú Principal</a>

    <script src="scripts_locales.js"></script> <!-- Vinculamos el archivo scripts.js -->
</body>
</html>