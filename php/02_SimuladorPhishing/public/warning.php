<?php
// warning.php - Página de advertencia tras completar el formulario

require_once '../app/Controllers/WarningController.php';

use App\Controllers\WarningController;

$warningController = new WarningController();
$warningController->showWarning();
?>
