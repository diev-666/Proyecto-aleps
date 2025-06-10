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
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 20px;
            font-size: 2em;
            animation: fadeIn 2s ease-in-out;
        }
        .btn-container {
            margin-top: 50px;
        }
        button {
            background-color: #1e1e1e;
            color: #fff;
            padding: 15px 30px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }
        button:hover {
            transform: scale(1.1);
            background-color: #333;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <h1>Revisar Quejas y Sugerencias</h1>
    <div class="btn-container">
        <!-- Formulario para revisar quejas o sugerencias -->
        <form action="revisarquejas.php" method="post">
            <button type="submit">Revisar Quejas/Sugerencias</button>
        </form>
    </div>
</body>
</html>
