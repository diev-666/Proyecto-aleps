<?php
// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "orientacion";

$conn = new mysqli($host, $usuario, $password, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombreAlumno = $conn->real_escape_string($_POST['nombre_alumno']);
$nombreTutor = $conn->real_escape_string($_POST['nombre_tutor']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$alergias = $conn->real_escape_string($_POST['alergias']);
$telefono = $conn->real_escape_string($_POST['telefono']);

// Insertar datos en la base de datos
$sql = "INSERT INTO salud (nombre_alumno, nombre_tutor, direccion, alergias, telefono) 
        VALUES ('$nombreAlumno', '$nombreTutor', '$direccion', '$alergias', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Información de salud guardada con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
