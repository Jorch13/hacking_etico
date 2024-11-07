<?php
require_once '../utils/http_request.php';
require_once '../utils/logger.php';

class CSRFDetection {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function scan() {
        Logger::log("Iniciando escaneo de CSRF en: $this->url");

        $response = HttpRequest::get($this->url);

        if ($this->hasCSRFProtection($response)) {
            Logger::log("Protección CSRF detectada en: $this->url");
            return [
                'url' => $this->url,
                'status' => 'protegido'
            ];
        } else {
            Logger::log("No se detectó protección CSRF en: $this->url");
            return [
                'url' => $this->url,
                'status' => 'no protegido'
            ];
        }
    }

    private function hasCSRFProtection($response) {
        // Verifica si el formulario incluye un campo CSRF (token, etc.)
        // Se busca un campo oculto típico de token CSRF
        $csrfIndicators = [
            'name="csrf_token"', // Nombre común para tokens CSRF
            'name="_csrf"',       // Otra variación común
            'name="token"',       // Variación genérica
            'type="hidden"',      // Campos ocultos pueden indicar protección
        ];

        foreach ($csrfIndicators as $indicator) {
            if (strpos($response, $indicator) !== false) {
                return true; // Protección CSRF detectada
            }
        }

        return false; // No se detectó protección CSRF
    }
}
?>
