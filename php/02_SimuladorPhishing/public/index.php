<?php
require_once '../app/Controllers/LoginController.php';

use App\Controllers\LoginController;

$base_path = 'http://localhost/2025/02_SimuladorPhishing/public'; // Ajusta a tu ruta de proyecto

$controller = new LoginController();

// Ruta principal para mostrar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!isset($_GET['route']) || $_GET['route'] === '')) {
    $controller->showLoginForm();
}

// Ruta para mostrar la página de advertencia
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'warning') {
    $controller->showWarning();
}

// Ruta para manejar el envío de datos del formulario
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleLogin($base_path);
}

// Redirecciona a la página de inicio si la ruta no es válida
else {
    header("Location: $base_path/");
    exit();
}
