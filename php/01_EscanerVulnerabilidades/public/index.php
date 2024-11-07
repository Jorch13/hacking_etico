<?php
// Incluir la configuración y los archivos necesarios
require_once '../config/config.php';
require_once '../core/scanner.php';  // Asegúrate de que la ruta sea correcta
require_once '../utils/logger.php';   // Asegúrate de que la ruta sea correcta

session_start();  // Inicia la sesión para almacenar los resultados

// Verifica si se ha enviado el formulario de escaneo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start_scan'])) {
    // Verifica que la URL se haya proporcionado
    if (isset($_POST['url'])) {
        $url = $_POST['url'];

        // Validar y sanitizar la URL
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Crear el escáner y ejecutar el escaneo
            $scanner = new VulnerabilityScanner($url);
            $_SESSION['scan_results'] = $scanner->scan();  // Guardar resultados en la sesión

            Logger::log("Escaneo iniciado en: $url");

            // Redirigir para mostrar los resultados del escaneo
            header("Location: index.php");
            exit;
        } else {
            echo "<p>La URL proporcionada no es válida. Por favor ingrese una URL válida.</p>";
        }
    }
}
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