<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
   
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Iniciar sesión</h2>
            <form id="loginForm" action="../public/index.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-submit">Iniciar sesión</button>
            </form>
            <p class="note">Nunca compartas tu información de inicio de sesión.</p>
        </div>
    </div>
    <!-- <script src="../public/assets/js/capture.js"></script> -->
</body>
</html>
