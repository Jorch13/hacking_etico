<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertencia de Seguridad</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <style>
        /* Estilos específicos para la página de advertencia */
        .warning-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* background-color: #1a1a1a; */
            /* Fondo oscuro */
            padding: 20px;
        }

        /* Caja de advertencia con bordes rojos y neón */
        .warning-box {
            max-width: 450px;
            width: 100%;
            background: #222222;
            /* Fondo oscuro de la caja */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            border: 2px solid #ff4c4c;
            /* Borde rojo brillante */
            transition: all 0.3s ease;
        }

        /* Efecto de hover sobre la caja */
        .warning-box:hover {
            box-shadow: 0 4px 20px rgba(255, 76, 76, 0.6);
            /* Efecto de neón rojo al pasar el ratón */
        }

        /* Título con color rojo brillante */
        .warning-box h2 {
            color: #ff4c4c;
            /* Rojo brillante */
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        /* Texto de la advertencia */
        .warning-box p {
            color: #d1d1d1;
            /* Gris claro para el texto */
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        /* Botón de retorno con estilo de neón rojo */
        .btn-return {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: #ff4c4c;
            /* Rojo brillante */
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        /* Efecto de hover en el botón */
        .btn-return:hover {
            background-color: #e64545;
            /* Rojo oscuro al pasar el ratón */
        }
    </style>
</head>

<body>
    <div class="warning-container">
        <div class="warning-box">
            <h2>¡Advertencia de Seguridad!</h2>
            <p>Este es un sitio de demostración de phishing. La información que has ingresado no será utilizada ni almacenada.</p>
            <p>Recuerda siempre verificar la autenticidad de los sitios web antes de ingresar tus datos personales.</p>
            <a href="../public/index.php" class="btn-return">Volver al Inicio</a>
        </div>
    </div>
</body>

</html>