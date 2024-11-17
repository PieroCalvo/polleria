<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Bebidas</title>
    <link rel="stylesheet" href="style.css"> <!-- Vinculamos el archivo style.css -->
</head>
<body>
    <h1>Gestión de Bebidas</h1>

    <!-- Formulario para agregar una nueva bebida -->
    <h2>Agregar Nueva Bebida</h2>
    <form id="bebidaForm" action="bebidas_agregar.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre de la Bebida:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ej: Coca Cola"><br>
        
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" placeholder="Ej: 5.00"><br>
        
        <label for="tamaño">Tamaño:</label><br>
        <input type="text" id="tamaño" name="tamaño" placeholder="Ej: 1 Litro"><br>

        <!-- Imagen y Vista Previa en la misma fila -->
        <div class="form-row">
            <div>
                <label for="imagen">Imagen de la Bebida:</label>
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

    <h2>Listado de Bebidas</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Tamaño</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            
            <?php
            $query = "SELECT * FROM Bebidas";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['precio'] . "</td>";
                    echo "<td>" . $row['tamaño'] . "</td>";
                    
                    echo "<td><img src='imagenes/" . $row['imagen'] . "' width='100'></td>";
                    echo "<td><a href='bebidas_editar.php?id=" . $row['id'] . "' class='btn'>Editar</a> <a href='bebidas_eliminar.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay bebidas registradas</td></tr>";
            }
            ?>
        </table>
    </div>
    
    <a href="menu.php" class="btn btn-menu">Volver al Menú Principal</a>

    <script src="scripts_bebidas.js"></script> <!-- Vinculamos el archivo scripts.js -->
</body>
</html>
