<?php
require_once '../utils/http_request.php';
require_once '../utils/logger.php';

class XSSScanner {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function scan() {
        Logger::log("Iniciando escaneo de XSS en: $this->url");

        $payloads = [
            '<script>alert("XSS")</script>',      // Payload de alerta básico
            '<img src=x onerror=alert("XSS")>',   // Payload de imagen onerror
            '"><script>alert("XSS")</script>',    // Inyección para escapar de atributos
            '<svg onload=alert("XSS")>',          // Payload SVG
        ];

        $results = [];

        foreach ($payloads as $payload) {
            $testUrl = $this->url . "?test=" . urlencode($payload);
            $response = HttpRequest::get($testUrl);

            if ($this->isVulnerable($response, $payload)) {
                Logger::log("Vulnerabilidad XSS detectada con el payload: $payload");
                $results[] = [
                    'payload' => $payload,
                    'url' => $testUrl,
                    'status' => 'vulnerable'
                ];
            } else {
                Logger::log("Sin vulnerabilidad detectada para el payload: $payload");
                $results[] = [
                    'payload' => $payload,
                    'url' => $testUrl,
                    'status' => 'no vulnerable'
                ];
            }
        }

        return $results;
    }

    private function isVulnerable($response, $payload) {
        // Verifica si el payload se refleja en la respuesta
        return strpos($response, $payload) !== false;
    }
}
?>
