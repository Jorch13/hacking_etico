<?php
require_once 'xss_detection.php';  // Si está en el mismo directorio
require_once 'sql_injection.php';
require_once 'csrf_detection.php';
require_once 'directory_exposure.php';
require_once '../utils/logger.php';

class VulnerabilityScanner
{
    private $url;

    public function __construct($url)
    {
        $this->url = rtrim($url, '/');
    }

    public function scan()
    {
        Logger::log("Iniciando escaneo de vulnerabilidades en: $this->url");

        // Instanciamos los detectores de vulnerabilidades
        $xssDetector = new XSSDetection($this->url);
        $sqlInjectionDetector = new SQLInjectionScanner($this->url);
        $csrfDetector = new CSRFDetection($this->url);
        $directoryExposureDetector = new DirectoryExposure($this->url);

        // Realizamos los escaneos
        $xssResults = $xssDetector->scan();
        $sqlInjectionResults = $sqlInjectionDetector->scan();
        $csrfResults = $csrfDetector->scan();
        $directoryExposureResults = $directoryExposureDetector->scan();

        // Mostrar los resultados
        $this->showResults($xssResults, 'XSS Detection');
        $this->showResults($sqlInjectionResults, 'SQL Injection Detection');
        $this->showResults($csrfResults, 'CSRF Detection');
        $this->showResults($directoryExposureResults, 'Directory Exposure Detection');
    }

    private function showResults($results, $title)
    {
        echo "<h2>$title</h2>";

        if (empty($results)) {
            echo "<p>No se encontraron vulnerabilidades en este análisis.</p>";
        } else {
            // Si $results es un solo resultado (un array asociativo), lo convertimos en un array
            if (isset($results['url'])) {
                $results = [$results]; // Convertimos el resultado en un array de un solo elemento
            }

            // Ahora podemos iterar sobre $results sin problemas
            foreach ($results as $result) {
                echo "<p>Archivo/Directorio: {$result['url']} - Estado: {$result['status']}</p>";
            }
        }
    }
}

// Uso del escáner
$url = null;
$message = "<p>Por favor, proporciona una URL para escanear.</p>";

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $scanner = new VulnerabilityScanner($url);
    $scanner->scan();
} else {
    $message = "<h2>Por favor, proporciona una URL para escanear.</h2>";
}
