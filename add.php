<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de agregar aquí
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $anio = $_POST['anio'];

    // Subir imagen
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["imagen"]["name"]);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile);

    // Guardar en la base de datos
    $sql = "INSERT INTO vehiculos (descripcion, marca, modelo, tipo, anio, imagen) VALUES ('$descripcion', '$marca', '$modelo', '$tipo', '$anio', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
