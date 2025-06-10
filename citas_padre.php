<?php
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

$fecha = $conn->real_escape_string($_POST['fecha']);
$hora = $conn->real_escape_string($_POST['hora']);
$nombre_estudiante = $conn->real_escape_string($_POST['nombre_estudiante']);
$nombre_padre = $conn->real_escape_string($_POST['nombre_padre']);
$motivo = $conn->real_escape_string($_POST['motivo']);

$sql = "INSERT INTO citas (fecha, hora, nombre_estudiante, nombre_padre, motivo) 
        VALUES ('$fecha', '$hora', '$nombre_estudiante', '$nombre_padre', '$motivo')";

if ($conn->query($sql) === TRUE) {
    echo "Cita agendada con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
