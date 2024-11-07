<?php
include 'config.php';
include 'utils/logger.php';

// Recibe los resultados del escáner, que deben haberse almacenado en un array.
$scanResults = isset($_SESSION['scan_results']) ? $_SESSION['scan_results'] : null;

function generateReport($scanResults) {
    // Si no hay resultados, muestra un mensaje de que no se encontraron vulnerabilidades.
    if (!$scanResults) {
        echo "<h2>No vulnerabilities found during the scan.</h2>";
        return;
    }

    echo "<h1>Vulnerability Scan Report</h1>";
    echo "<p><strong>Scan Date:</strong> " . date("Y-m-d H:i:s") . "</p>";
    echo "<h2>Scan Results</h2>";

    // Recorre los resultados y muestra cada vulnerabilidad detectada.
    echo "<table border='1'>";
    echo "<thead><tr><th>Vulnerability</th><th>Description</th><th>Status</th></tr></thead>";
    echo "<tbody>";

    foreach ($scanResults as $result) {
        $statusClass = $result['status'] == 'Vulnerable' ? 'style="background-color: red; color: white;"' : 'style="background-color: green; color: white;"';
        echo "<tr $statusClass>";
        echo "<td>" . htmlspecialchars($result['name']) . "</td>";
        echo "<td>" . htmlspecialchars($result['description']) . "</td>";
        echo "<td>" . htmlspecialchars($result['status']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    // Muestra la opción para guardar el reporte.
    echo "<br><a href='download_report.php'>Download Full Report</a>";
}

// Genera el reporte con los resultados del escaneo
generateReport($scanResults);
?>
