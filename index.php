<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario iCar</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">iCar Plus</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#verRegistros">Ver Registros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#agregarRegistro">Agregar Registro</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Sección para agregar vehículo -->
    <div id="agregarRegistro">
        <h2>Agregar Registro</h2>
        <form id="formularioAgregar" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="mb-3">
                <label for="anio" class="form-label">Año:</label>
                <input type="number" class="form-control" id="anio" name="anio" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>

    <!-- Sección para ver registros -->
    <div id="verRegistros" class="mt-4">
        <h2>Ver Registros</h2>
        <div id="listaVehiculos">
            
        <?php
        include('includes/db.php');

        $sql = "SELECT * FROM vehiculos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'><thead class='thead-light'><tr><th>Descripción</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Año</th><th>Imagen</th><th>Acciones</th></tr></thead><tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['marca'] . "</td>";
                echo "<td>" . $row['modelo'] . "</td>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "<td>" . $row['anio'] . "</td>";
                echo "<td><img src='" . $row['imagen'] . "' class='img-thumbnail' width='50' data-bs-toggle='modal' data-bs-target='#modalImagen" . $row['id'] . "'></td>";
                echo "<td>
                        <a href='#' class='btn btn-warning btn-editar' data-bs-toggle='modal' data-bs-target='#modalEditar" . $row['id'] . "'>Editar</a>
                        <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>
                    </td>";
                echo "</tr>";

                // Modal de Editar
                echo "<div class='modal fade' id='modalEditar" . $row['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Editar Vehículo</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <!-- Utiliza el mismo formulario de agregar -->
                                    <form action='edit.php' method='post'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <div class='mb-3'>
                                            <label for='descripcionEdit' class='form-label'>Descripción</label>
                                            <input type='text' class='form-control' id='descripcionEdit' name='descripcion' value='" . $row['descripcion'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='marcaEdit' class='form-label'>Marca</label>
                                            <input type='text' class='form-control' id='marcaEdit' name='marca' value='" . $row['marca'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='modeloEdit' class='form-label'>Modelo</label>
                                            <input type='text' class='form-control' id='modeloEdit' name='modelo' value='" . $row['modelo'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='tipoEdit' class='form-label'>Tipo</label>
                                            <input type='text' class='form-control' id='tipoEdit' name='tipo' value='" . $row['tipo'] . "' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='anioEdit' class='form-label'>Año</label>
                                            <input type='text' class='form-control' id='anioEdit' name='anio' value='" . $row['anio'] . "' required>
                                        </div>

                                        <!-- Puedes agregar campos adicionales aquí -->
                                        
                                        <button type='submit' class='btn btn-primary'>Guardar Cambios</button>
                                    </form>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>";

                // Modal de Imagen
                echo "<div class='modal fade' id='modalImagen" . $row['id'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <img src='" . $row['imagen'] . "' class='img-fluid'>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>";
            }

            echo "</tbody></table>";
        } else {
            echo "0 resultados";
        }

        $conn->close();
        ?>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>
