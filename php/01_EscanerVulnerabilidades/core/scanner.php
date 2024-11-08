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

        // Guardar el reporte en un archivo HTML
        $this->saveReport([
            'xssResults' => $xssResults,
            'sqlInjectionResults' => $sqlInjectionResults,
            'csrfResults' => $csrfResults,
            'directoryExposureResults' => $directoryExposureResults
        ]);

        // Retornar los resultados para ser usados externamente
        return [
            'xssResults' => $xssResults,
            'sqlInjectionResults' => $sqlInjectionResults,
            'csrfResults' => $csrfResults,
            'directoryExposureResults' => $directoryExposureResults
        ];
    }

    // Método privado para generar el HTML
    private function showResults($results, $title)
    {
        $output = "<h2>$title</h2>";

        if (empty($results)) {
            $output .= "<p>No se encontraron vulnerabilidades en este análisis.</p>";
        } else {
            // Si $results es un solo resultado (un array asociativo), lo convertimos en un array
            if (isset($results['url'])) {
                $results = [$results]; // Convertimos el resultado en un array de un solo elemento
            }

            // Ahora podemos iterar sobre $results sin problemas
            foreach ($results as $result) {
                $output .= "<p>Archivo/Directorio: {$result['url']} - Estado: {$result['status']}</p>";
            }
        }

        return $output;  // Devolvemos el HTML generado
    }

    // Método público para obtener los resultados en formato HTML
    public function getResultsHTML($results)
    {
        $html = '';
        $html .= $this->showResults($results['xssResults'], 'XSS Detection');
        $html .= $this->showResults($results['sqlInjectionResults'], 'SQL Injection Detection');
        $html .= $this->showResults($results['csrfResults'], 'CSRF Detection');
        $html .= $this->showResults($results['directoryExposureResults'], 'Directory Exposure Detection');
        return $html;
    }

    // Método para guardar los resultados del escaneo en un archivo HTML
    private function saveReport($scanResults)
    {
        // Generar el contenido HTML del reporte
        $reportHTML = $this->getResultsHTML($scanResults);

        // Determinar el nombre del archivo para el reporte
        $reportFilename = '../reports/report_' . time() . '.html';

        // Guardar el reporte en el archivo
        file_put_contents($reportFilename, $reportHTML);

        Logger::log("Reporte guardado en: $reportFilename");
    }
}
