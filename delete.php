<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar de la base de datos
    $sql = "DELETE FROM vehiculos WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

$conn->close();
?>
