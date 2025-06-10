<?php

$host = 'localhost'; // Cambia si tu base de datos está en otro servidor
$usuario = 'root';   // Tu usuario de MySQL
$contrasena = '';    // Tu contraseña de MySQL
$base_de_datos = 'orientacion'; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Comprobar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar horario si no existe
$sql_horario = "SELECT * FROM horarios_orientador";
$result = $conn->query($sql_horario);
if ($result->num_rows == 0) {
    // Inserta el horario de trabajo del orientador si no existe
    $insert_horario = "INSERT INTO horarios_orientador (orientador_nombre, hora_inicio, hora_fin) VALUES ('Orientador', '06:40:00', '16:00:00')";
    $conn->query($insert_horario);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agregar cita
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $motivo = $_POST['motivo'];

    // Verificar si la hora está dentro del horario del orientador
    $sql_horario = "SELECT hora_inicio, hora_fin FROM horarios_orientador WHERE orientador_nombre = 'Orientador'";
    $resultado_horario = $conn->query($sql_horario);
    $horario = $resultado_horario->fetch_assoc();

    if ($hora >= $horario['hora_inicio'] && $hora <= $horario['hora_fin']) {
        // Insertar cita si está dentro del horario
        $sql_insert_cita = "INSERT INTO citas (fecha, hora, orientador_id, nombre_estudiante, motivo) 
                            VALUES ('$fecha', '$hora', 1, '$nombre_estudiante', '$motivo')";
        if ($conn->query($sql_insert_cita) === TRUE) {
            echo "<div class='alert success'>Cita agendada con éxito.</div>";
        } else {
            echo "<div class='alert error'>Error al agendar la cita: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert error'>La hora de la cita debe estar dentro del horario de trabajo (6:40 AM - 4:00 PM).</div>";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Citas</title>
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
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #ff7043;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 8px;
            border: 2px solid #333;
            background-color: #2a2a2a;
            color: white;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff7043;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e64a19;
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .success {
            background-color: #388e3c;
        }

        .error {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agendar Citas</h1>
        <form method="POST">
            <input type="text" name="nombre_estudiante" placeholder="Nombre del estudiante" required>
            <input type="date" name="fecha" required>
            <input type="time" name="hora" required>
            <textarea name="motivo" placeholder="Motivo de la cita" required></textarea>
            <button type="submit">Agendar Cita</button>
        </form>
    </div>
</body>
</html>
