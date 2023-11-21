<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Verificar si el registro existe antes de intentar editarlo
    $sql_check = "SELECT * FROM vehiculos WHERE id = $id";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $descripcion = $_POST['descripcion'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo'];
        $anio = $_POST['anio'];

        // Verificar si se subió una nueva imagen
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_temp = $_FILES['imagen']['tmp_name'];
            $imagen_nombre = $_FILES['imagen']['name'];
            $ruta_imagen = "images/" . uniqid() . "_" . $imagen_nombre;
            move_uploaded_file($imagen_temp, $ruta_imagen);

            // Actualizar el registro con la nueva imagen
            $sql_update = "UPDATE vehiculos SET descripcion = '$descripcion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', anio = '$anio', imagen = '$ruta_imagen' WHERE id = $id";
        } else {
            // Si no se subió una nueva imagen, actualizar el registro sin cambiar la imagen
            $sql_update = "UPDATE vehiculos SET descripcion = '$descripcion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', anio = '$anio' WHERE id = $id";
        }

        if ($conn->query($sql_update) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No se encontró el registro para editar.";
    }
}

$conn->close();
?>
