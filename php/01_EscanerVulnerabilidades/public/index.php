<?php
// session_start(); // Ya no es necesario, ya que esto se maneja en el controlador

// Los resultados se pasan desde el controlador
$resultados = $datos["scan_results_html"] ?? NULL; // Utilizamos "scan_results_html" en lugar de "scan_results"
$error_message = $datos["error_message"] ?? NULL; // Para mostrar un mensaje de error si existe
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Scanner</title>
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="stylesheet" href="../public/styles/result.css">
</head>

<body>

    <div class="container">
        <h1>Vulnerability Scanner</h1>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Mostrar los resultados del escaneo si existen -->
        <?php if ($resultados): ?>
            <div class="result-container">
                <?php echo $resultados; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para ingresar la URL -->
        <form method="POST" action="../controllers/urlController.php">
            <label for="url">Ingrese la URL a escanear:</label>
            <input type="text" id="url" name="url" placeholder="https://ejemplo.com" required>
            <button type="submit" name="start_scan" class="start-scan-button">Iniciar </button>
        </form>
    </div>

</body>

</html>