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

// Consulta de reportes
$sql = "SELECT * FROM reportes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reportes</title>
    <link rel="stylesheet" href="reportes_alumnos.css">
</head>
<body>
    <div class="background">
        <div class="form-container">
            <h2>Lista de Reportes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Número de Control</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['numero_control'] ?></td>
                            <td><?= $row['fecha'] ?></td>
                            <td><?= $row['motivo'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button onclick="window.location.href='index.html'">Regresar</button>
        </div>
    </div>
</body>
</html>
