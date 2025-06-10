<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar Datos</title>
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
    <h1>Salud</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre del Alumno</th>
            <th>Nombre del Tutor</th>
            <th>Dirección</th>
            <th>Alergias</th>
            <th>Teléfono</th>
        </tr>

        <?php
        $conexion = new mysqli("localhost", "root", "", "orientacion");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql = "SELECT * FROM salud";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $fila['id'] . "</td>
                        <td>" . $fila['nombre_alumno'] . "</td>
                        <td>" . $fila['nombre_tutor'] . "</td>
                        <td>" . $fila['direccion'] . "</td>
                        <td>" . $fila['alergias'] . "</td>
                        <td>" . $fila['telefono'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay datos registrados.</td></tr>";
        }

        $conexion->close();
        ?>
    </table>
</body>
</html>
