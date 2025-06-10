<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar Quejas y Sugerencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            text-align: center;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #1e1e1e;
        }
        tr:nth-child(even) {
            background-color: #1e1e1e;
        }
    </style>
</head>
<body>
    <h1>Revisar Quejas y Sugerencias</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>

        <?php
        $conexion = new mysqli("localhost", "root", "", "orientacion");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql = "SELECT * FROM quejas_sugerencias ORDER BY fecha DESC";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($fila['id']) . "</td>
                        <td>" . htmlspecialchars($fila['nombre']) . "</td>
                        <td>" . htmlspecialchars($fila['correo']) . "</td>
                        <td>" . htmlspecialchars($fila['tipo']) . "</td>
                        <td>" . htmlspecialchars($fila['mensaje']) . "</td>
                        <td>" . htmlspecialchars($fila['fecha']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay quejas ni sugerencias registradas.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>
</body>
</html>
