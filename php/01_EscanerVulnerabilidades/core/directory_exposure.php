<?php
require_once '../utils/http_request.php';
require_once '../utils/logger.php';

class DirectoryExposure {
    private $url;

    public function __construct($url) {
        $this->url = rtrim($url, '/') . '/';
    }

    public function scan() {
        Logger::log("Iniciando escaneo de directorios expuestos en: $this->url");

        $directoriesToCheck = [
            '.git/',          // Carpeta de control de versiones Git
            'backup/',        // Carpeta de respaldos
            'uploads/',       // Carpeta de cargas, común en WordPress
            'config/',        // Carpeta de configuración
            'admin/',         // Directorio de administración
            'logs/',          // Carpeta de registros (logs)
            'database/',      // Directorio de bases de datos o respaldos
        ];

        $results = [];

        foreach ($directoriesToCheck as $directory) {
            $directoryUrl = $this->url . $directory;
            $response = HttpRequest::get($directoryUrl);

            if ($this->isExposed($response)) {
                Logger::log("Directorio expuesto detectado: $directoryUrl");
                $results[] = [
                    'directory' => $directory,
                    'url' => $directoryUrl,
                    'status' => 'expuesto'
                ];
            } else {
                Logger::log("Directorio no expuesto: $directoryUrl");
                $results[] = [
                    'directory' => $directory,
                    'url' => $directoryUrl,
                    'status' => 'no expuesto'
                ];
            }
        }

        return $results;
    }

    private function isExposed($response) {
        // Verifica si el directorio está expuesto buscando listados de archivos o mensajes típicos
        $exposureIndicators = [
            'Index of',         // Indicación de un listado de directorio
            'Parent Directory', // Común en listados de directorio
            'directory listing', // Mensaje común en servidores con directorios expuestos
            '403 Forbidden',    // Indicación de acceso restringido (potencialmente expuesto)
        ];

        foreach ($exposureIndicators as $indicator) {
            if (strpos($response, $indicator) !== false) {
                return true;
            }
        }

        return false;
    }
}
?>
