// Selección de elementos del DOM específicos para la tabla "Otros Platos"
const dragArea = document.getElementById('dragArea');
const imageInput = document.getElementById('imagen');
const imagePreview = document.getElementById('imagePreview');
const imageName = document.getElementById('imageName');

// Verificar si estamos en la página de actualización para otros platos
const form = document.querySelector('#platoForm');
const actionUrl = form.getAttribute('action');
const isUpdating = actionUrl.includes('otros_platos_actualizar.php'); // Verifica si es un formulario de actualización

// EventListeners para arrastrar y soltar imágenes
dragArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dragArea.classList.add('active');
});

dragArea.addEventListener('dragleave', () => {
    dragArea.classList.remove('active');
});

dragArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dragArea.classList.remove('active');
    const file = event.dataTransfer.files[0];
    if (file && file.type === 'image/jpeg') {
        imageInput.files = event.dataTransfer.files;
        showImagePreview({ target: { files: [file] } });
        imageName.textContent = 'Nombre de la imagen: ' + file.name; // Mostrar nombre del archivo
    } else {
        alert('Solo se permiten imágenes JPG');
    }
});

// Función para mostrar la vista previa de la imagen
function showImagePreview(event) {
    const file = event.target.files[0];
    if (file && file.type === 'image/jpeg') {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
        imageName.textContent = 'Nombre de la imagen: ' + file.name; // Mostrar nombre del archivo
    } else {
        alert('Solo se permiten imágenes JPG');
    }
}

// Verificación al enviar el formulario para la gestión de otros platos
form.addEventListener('submit', (event) => {
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;
    const descripcion = document.getElementById('descripcion').value;
    const imagen = document.getElementById('imagen').value;

    // Verificación para formulario de agregar (si no es actualización)
    if (!isUpdating && (!nombre || !precio || !descripcion || !imagen)) {
        event.preventDefault();
        alert('Debes completar todos los campos');
    }

    // Verificación para formulario de actualización (imagen no es requerida)
    if (isUpdating && (!nombre || !precio || !descripcion)) {
        event.preventDefault();
        alert('Debes completar todos los campos');
    }
});