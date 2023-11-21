// Función para agregar un vehículo
function agregarVehiculo(data) {
    fetch('add.php', {
        method: 'POST',
        body: data,
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
       
    })
    .catch(error => console.error('Error:', error));
}

// Función para editar un vehículo
function editarVehiculo(data) {
    fetch('edit.php', {
        method: 'POST',
        body: data,
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        
    })
    .catch(error => console.error('Error:', error));
}

// Función para eliminar un vehículo
function eliminarVehiculo(id) {
    fetch(`delete.php?id=${id}`, {
        method: 'GET',
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
       
    })
    .catch(error => console.error('Error:', error));
}

// Evento para agregar un vehículo
document.getElementById('formularioAgregar').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    agregarVehiculo(formData);

    // Limpiar formulario después de agregar
    this.reset();

    // Recargar la lista de vehículos después de agregar
    cargarVehiculos();
});

// Evento para editar un vehículo
document.getElementById('formularioEditar').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    editarVehiculo(formData);

    // Limpiar formulario después de editar (si es necesario)
    this.reset();

    // Recargar la lista de vehículos después de editar
    cargarVehiculos();
});

// Evento para eliminar un vehículo
function eliminarVehiculoClick(id) {
    eliminarVehiculo(id);

    // Recargar la lista de vehículos después de eliminar
    cargarVehiculos();
}

// Función para cargar la lista de vehículos
function cargarVehiculos() {
    fetch('index.php', {
        method: 'GET',
    })
    .then(response => response.text())
    .then(result => {
    
        document.getElementById('listaVehiculos').innerHTML = result;
    })
    .catch(error => console.error('Error:', error));
}




