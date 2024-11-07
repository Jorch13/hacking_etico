// app.js

document.addEventListener('DOMContentLoaded', function () {
    const startScanButton = document.querySelector('.start-scan-button');

    // Evento para mostrar una notificación cuando el escaneo empieza
    if (startScanButton) {
        startScanButton.addEventListener('click', function () {
            // Puede ser un buen lugar para mostrar un mensaje de carga o animación
            alert("Scan started! Please wait.");
        });
    }
});
