<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "orientacion";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$nombre_padre = $_POST['nombre_padre'];
$correo = $_POST['correo'];
$tipo = $_POST['tipo'];
$mensaje = $_POST['mensaje'];

// Insertar datos en la tabla
$sql = "INSERT INTO quejas_sugerencias_padre (nombre, nombre_padre, correo, tipo, mensaje) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $nombre_padre, $correo, $tipo, $mensaje);

if ($stmt->execute()) {
    echo "<h2>¡Gracias por tu mensaje!</h2>";
    echo "<p>Tu información ha sido registrada exitosamente.</p>";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
