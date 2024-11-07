<?php

// Configuración básica del escáner
$config = [
    'scan' => [
        'sql_injection' => true,  // Activar/Desactivar detección de inyecciones SQL
        'xss' => true,            // Activar/Desactivar detección de XSS
        'csrf' => true,           // Activar/Desactivar detección de CSRF
        'directory_exposure' => true, // Activar/Desactivar detección de directorios expuestos
    ],
    'http' => [
        'timeout' => 30,           // Tiempo máximo de espera en segundos para cada solicitud
        'user_agent' => 'Mozilla/5.0 (compatible; PHP Vulnerability Scanner)', // User Agent para las solicitudes HTTP
    ],
    'logging' => [
        'enabled' => true,        // Activar/desactivar logging
        'log_file' => '../logs/scanner.log', // Ruta del archivo de log
    ],
    'other' => [
        'scan_subdirectories' => true,  // Activar/desactivar escaneo de subdirectorios
    ]
];

// Función para obtener una configuración
function getConfig($key) {
    global $config;

    $keys = explode('.', $key);
    $value = $config;

    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return null; // Si no existe la clave, retorna null
        }
    }

    return $value;
}

// Función para establecer una configuración
function setConfig($key, $value) {
    global $config;

    $keys = explode('.', $key);
    $arrayRef = &$config;

    foreach ($keys as $k) {
        if (!isset($arrayRef[$k])) {
            $arrayRef[$k] = [];
        }
        $arrayRef = &$arrayRef[$k];
    }

    $arrayRef = $value;
}

?>
