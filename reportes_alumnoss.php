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

// Eliminación de registros
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM reportes WHERE id = $id");
}

// Consulta de reportes
$sql = "SELECT * FROM reportes $filtro";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Retardos</title>
    <link rel="stylesheet" href="reportes_alumnos.css">
</head>
<body>
    <header>
        <h1>Gestión de Reportes y Retardos</h1>
        <p>Administra los registros de manera eficiente</p>
    </header>

    <main>
        <!-- Barra de búsqueda -->
        <form method="POST" class="search-form">
            <input type="text" name="buscar" placeholder="Buscar por nombre o número de control">
            <button type="submit">Buscar</button>
        </form>

        <!-- Tabla de reportes -->
        <table class="reportes-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Control</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['numero_control']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['motivo']); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="eliminar" class="delete-button">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No se encontraron registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>© 2024 Gestión de Reportes y Retardos</p>
    </footer>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #121212;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            text-align: center;
            margin: 20px 0;
        }

        .search-form {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-form input {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2b2b2b;
            color: #fff;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .reportes-table {
            width: 90%;
            max-width: 800px;
            border-collapse: collapse;
            background-color: rgba(28, 28, 28, 0.95);
            text-align: left;
        }

        .reportes-table th, .reportes-table td {
            padding: 15px;
            border: 1px solid #333;
        }

        .reportes-table th {
            background-color: #333;
        }

        .reportes-table td {
            color: #b3b3b3;
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

        footer {
            margin-top: auto;
            text-align: center;
            padding: 10px;
            background: #1b1b1b;
        }
    </style>
</body>
</html>
