<?php
// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "orientacion";


$conn = new mysqli($host, $usuario, $password, $baseDatos);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$nombre = $conn->real_escape_string($_POST['nombre']);
$numeroControl = $conn->real_escape_string($_POST['numero-control']);
$fecha = $conn->real_escape_string($_POST['fecha']);
$motivo = $conn->real_escape_string($_POST['motivo']);


$sql = "INSERT INTO reportes (nombre, numero_control, fecha, motivo) 
        VALUES ('$nombre', '$numeroControl', '$fecha', '$motivo')";

if ($conn->query($sql) === TRUE) {
    echo "Reporte guardado con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
