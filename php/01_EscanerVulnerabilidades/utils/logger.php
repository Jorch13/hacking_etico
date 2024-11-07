<?php

class Logger {
    private static $logFile = '../logs/scanner.log'; // Ruta del archivo de log

    /**
     * Registra un mensaje en el archivo de log.
     * 
     * @param string $message El mensaje a registrar.
     */
    public static function log($message) {
        $timestamp = date("Y-m-d H:i:s");
        $formattedMessage = "[$timestamp] $message" . PHP_EOL;

        // Escribe el mensaje en el archivo de log
        file_put_contents(self::$logFile, $formattedMessage, FILE_APPEND);

        // Opcional: imprime el mensaje en la consola o salida web
        echo $formattedMessage;
    }

    /**
     * Establece una ruta personalizada para el archivo de log.
     * 
     * @param string $filePath Ruta personalizada para el archivo de log.
     */
    public static function setLogFile($filePath) {
        self::$logFile = $filePath;
    }
}

?>
