<?php
// index.php - Página principal del formulario de inicio de sesión falso

require_once '../app/Controllers/LoginController.php';

use App\Controllers\LoginController;

$loginController = new LoginController();
$loginController->showLoginForm();
?>
