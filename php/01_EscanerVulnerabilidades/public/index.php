<?php
// Incluir la configuración y los archivos necesarios
require_once '../config/config.php';
require_once '../core/scanner.php';  // Asegúrate de que la ruta sea correcta
require_once '../utils/logger.php';   // Asegúrate de que la ruta sea correcta

session_start();  // Inicia la sesión para almacenar los resultados

// Habilitar la visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Evitar cualquier salida antes de la redirección
ob_start();

// Depuración: Verificar si la sesión está vacía
var_dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start_scan'])) {
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Depuración: Verificar que la URL es válida
        var_dump($url);

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Crear el objeto de escaneo
            $scanner = new VulnerabilityScanner($url);

            // Depuración: Verificar el objeto del escáner
            var_dump($scanner);

            $_SESSION['scan_results'] = $scanner->scan();  // Guardar los resultados en la sesión

            // Depuración: Verificar los resultados del escaneo
            var_dump($_SESSION['scan_results']);

            Logger::log("Escaneo iniciado en: $url");

            // Redirigir después de un escaneo exitoso
            
        } else {
            echo "<p>La URL proporcionada no es válida. Por favor ingrese una URL válida.</p>";
        }
    }
}

// Finaliza el buffering de salida
ob_end_flush();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Scanner</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h1>Vulnerability Scanner</h1>
        <?php
        if (isset($message) && !empty($message)) {
            echo $message;
        }
        ?>

        <!-- Formulario para ingresar la URL -->
        <form method="POST" action="index.php">
            <label for="url">Ingrese la URL a escanear:</label>
            <input type="text" id="url" name="url" placeholder="https://ejemplo.com" required>
            <button type="submit" name="start_scan" class="start-scan-button">Start Scan</button>
        </form>

        <?php if (isset($_SESSION['scan_results'])): ?>
            <h2>Scan Results</h2>
            <a href="report.php">View Detailed Report</a>
        <?php endif; ?>
    </div>

    <script src="app.js"></script>
</body>

</html>