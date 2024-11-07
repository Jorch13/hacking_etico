<?php
require_once 'sql_injection.php';
require_once 'xss_detection.php';
require_once 'csrf_detection.php';
require_once 'directory_exposure.php';
require_once '../utils/logger.php';
require_once '../utils/report.php';

class VulnerabilityScanner {
    public function runScan() {
        Logger::log("Iniciando escaneo de vulnerabilidades...");

        // Escaneo de SQL Injection
        $sqlInjection = new SQLInjectionScanner();
        $sqlResults = $sqlInjection->scan();
        
        // Escaneo de XSS
        $xssScanner = new XSSDetection();
        $xssResults = $xssScanner->scan();

        // Escaneo de CSRF
        $csrfScanner = new CSRFDetection();
        $csrfResults = $csrfScanner->scan();

        // Escaneo de Archivos expuestos
        $dirExposure = new DirectoryExposureScanner();
        $dirResults = $dirExposure->scan();

        // Generación de reporte
        $results = array_merge($sqlResults, $xssResults, $csrfResults, $dirResults);
        Report::generate($results);
    }
}

$scanner = new VulnerabilityScanner();
$scanner->runScan();
?>
