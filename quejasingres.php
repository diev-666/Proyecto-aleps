<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Queja/Sugerencia</title>
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
        input, textarea, button {
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
    <h1>Ingresar Queja o Sugerencia</h1>
    <form action="ingresar.php" method="post">
        <input type="text" name="nombre" placeholder="Tu Nombre" required><br>
        <input type="email" name="correo" placeholder="Tu Correo" required><br>
        <select name="tipo" required>
            <option value="Queja">Queja</option>
            <option value="Sugerencia">Sugerencia</option>
        </select><br>
        <textarea name="mensaje" rows="5" placeholder="Escribe tu mensaje" required></textarea><br>
        <button type="submit" name="guardar">Enviar</button>
    </form>

    <?php
    if (isset($_POST['guardar'])) {
        $conexion = new mysqli("localhost", "root", "", "orientacion");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $tipo = $_POST['tipo'];
        $mensaje = $_POST['mensaje'];

        $sql = "INSERT INTO quejas_sugerencias (nombre, correo, tipo, mensaje)
                VALUES ('$nombre', '$correo', '$tipo', '$mensaje')";

        if ($conexion->query($sql) === TRUE) {
            echo "<p>Gracias por tu " . ($tipo == 'Queja' ? "queja" : "sugerencia") . ", será revisada.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conexion->error . "</p>";
        }

        $conexion->close();
    }
    ?>
</body>
</html>
