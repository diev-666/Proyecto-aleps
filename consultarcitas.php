<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_de_datos = 'orientacion';

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id_cita = intval($_POST['id_cita']);
    $conn->query("DELETE FROM citas WHERE id = $id_cita");
}

$sql = "SELECT c.id, c.fecha, c.hora, c.nombre_estudiante, c.motivo, c.nombre_padre
        FROM citas c
        ORDER BY c.fecha, c.hora";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Citas</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #ff7043;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
        }

        td {
            background-color: #2a2a2a;
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #d32f2f;
        }

        .delete-button {
            padding: 5px 10px;
            background-color: #e53935;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Citas Pendientes</h1>

        <?php
        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Fecha</th><th>Hora</th><th>Estudiante</th><th>Motivo</th><th>Nombre del Padre</th><th>Acciones</th></tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['hora'] . "</td>";
                echo "<td>" . $fila['nombre_estudiante'] . "</td>";
                echo "<td>" . $fila['motivo'] . "</td>";
                echo "<td>" . $fila['nombre_padre'] . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='id_cita' value='" . $fila['id'] . "'>
                            <button type='submit' name='eliminar' class='delete-button'>Eliminar</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='alert'>No hay citas pendientes.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
