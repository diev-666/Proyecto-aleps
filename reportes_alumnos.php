<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'orientacion';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Lógica de búsqueda
$filtro = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $busqueda = $conn->real_escape_string($_POST['buscar']);
    $filtro = "WHERE nombre LIKE '%$busqueda%' OR numero_control LIKE '%$busqueda%'";
}

// Consulta de reportes
$sql = "SELECT * FROM reportes $filtro";
$result = $conn->query($sql);

// Convertir los resultados en un arreglo para enviarlo al HTML
$reportes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reportes[] = $row;
    }
}

// Enviar los reportes al HTML
echo json_encode($reportes);

$conn->close();
