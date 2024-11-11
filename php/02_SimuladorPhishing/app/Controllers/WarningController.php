<?php
// WarningController.php - Controlador para mostrar la advertencia de phishing

namespace App\Controllers;

class WarningController {
    public function showWarning() {
        include '../app/Views/warningView.php';
    }
}
