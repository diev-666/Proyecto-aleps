<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            text-align: center;
        }
        form {
            margin-top: 30px;
        }
        input, button {
            margin: 10px;
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
        }
        button {
            background-color: #1e1e1e;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }
        button:hover {
            transform: scale(1.1);
            background-color: #333;
        }
    </style>
</head>
<body>
    <h1>Salud</h1>
    <form action="guardar.php" method="post">
        <input type="text" name="nombre_alumno" placeholder="Nombre del Alumno" required><br>
        <input type="text" name="nombre_tutor" placeholder="Nombre del Tutor" required><br>
        <input type="text" name="direccion" placeholder="Dirección" required><br>
        <input type="text" name="alergias" placeholder="Alergias" required><br>
        <input type="text" name="telefono" placeholder="Teléfono" required><br>
        <button type="submit" name="guardar">Guardar</button>
    </form>

    <?php
    if (isset($_POST['guardar'])) {
        $conexion = new mysqli("localhost", "root", "", "orientacion");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $nombre_alumno = $_POST['nombre_alumno'];
        $nombre_tutor = $_POST['nombre_tutor'];
        $direccion = $_POST['direccion'];
        $alergias = $_POST['alergias'];
        $telefono = $_POST['telefono'];

        $sql = "INSERT INTO salud (nombre_alumno, nombre_tutor, direccion, alergias, telefono)
                VALUES ('$nombre_alumno', '$nombre_tutor', '$direccion', '$alergias', '$telefono')";

        if ($conexion->query($sql) === TRUE) {
            echo "<p>Datos guardados correctamente.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conexion->error . "</p>";
        }

        $conexion->close();
    }
    ?>
</body>
</html>
