<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario_icar";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
