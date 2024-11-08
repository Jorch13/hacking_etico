<?php
session_start();  // Inicia la sesión antes de cualquier acceso a $_SESSION

require_once '../config/config.php';
require_once '../core/scanner.php';
require_once '../utils/logger.php';
require_once '../controllers/ViewController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start_scan'])) {
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Crear el objeto de escaneo
            $scanner = new VulnerabilityScanner($url);
            $scanResults = $scanner->scan();  // Almacena los resultados del escaneo

            // Llamar al método público para obtener el HTML de los resultados
            $scanResultsHTML = $scanner->getResultsHTML($scanResults);

            // Muestra la vista con los resultados del escaneo
            ViewController::mostrar('../public/index.php', ['scan_results_html' => $scanResultsHTML]);
        } else {
            $_SESSION['error_message'] = "La URL proporcionada no es válida.";
            ViewController::mostrar('../public/index.php', ['error_message' => $_SESSION['error_message']]);
        }
    }
} else {
    // Si no se realiza una solicitud POST, simplemente muestra el formulario de inicio
    ViewController::mostrar('../public/index.php');
}
