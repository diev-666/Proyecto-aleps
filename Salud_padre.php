<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombreAlumno = isset($_POST['nombreAlumno']) ? htmlspecialchars($_POST['nombreAlumno']) : '';
    $nombreTutor = isset($_POST['nombreTutor']) ? htmlspecialchars($_POST['nombreTutor']) : '';
    $direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '';
    $alergias = isset($_POST['alergias']) ? htmlspecialchars($_POST['alergias']) : 'No especificado';
    $telefono = isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : '';

    // Validación básica de datos
    $errores = [];

    if (empty($nombreAlumno)) {
        $errores[] = "El nombre del alumno es obligatorio.";
    }

    if (empty($nombreTutor)) {
        $errores[] = "El nombre del tutor es obligatorio.";
    }

    if (empty($direccion)) {
        $errores[] = "La dirección es obligatoria.";
    }

    if (empty($telefono)) {
        $errores[] = "El teléfono de contacto es obligatorio.";
    }

    // Configuración de conexión a la base de datos (ejemplo)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "orientacion";

    // Si no hay errores, proceder con el guardado
    if (empty($errores)) {
        try {
            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                throw new Exception("Error de conexión: " . $conn->connect_error);
            }

            // Si la conexión es exitosa
            echo "<p>Conexión exitosa a la base de datos.</p>";

            // Preparar consulta SQL
            $sql = "INSERT INTO salud (nombre_alumno, nombre_tutor, direccion, alergias, telefono) 
                    VALUES (?, ?, ?, ?, ?)";

            // Preparar y ejecutar declaración
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $nombreAlumno, $nombreTutor, $direccion, $alergias, $telefono);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir con mensaje de éxito
                echo "<p>Datos guardados correctamente.</p>";
                // Si prefieres redirigir después de mostrar el mensaje, puedes hacerlo así:
                // header("Location: confirmacion.php?status=success");
                // exit();
            } else {
                throw new Exception("Error al guardar los datos: " . $stmt->error);
            }

            // Cerrar declaración y conexión
            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            // Mostrar el error en caso de falla
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        // Si hay errores, mostrarlos
        foreach ($errores as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>

