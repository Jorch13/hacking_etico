<?php

use Jmd\GestionTareas\config\Parametros;
use Jmd\GestionTareas\helpers\Authentication;
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Gestión de Tareas</title>
    <meta name="author" content="Jorge Moya">
    <meta name="year" content="2024">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= Parametros::$URL_BASE ?>assets/css/scss/styles.css">
    <link rel="stylesheet" type="text/css" href="<?= Parametros::$URL_BASE ?>assets/css/style.css">
    <script src="<?= Parametros::$URL_BASE ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-fondo-body">
    <!-- CABECERA -->
    <div class="container-fluid text-blanco bg-verde-claro d-flex justify-content-center">
        <nav class="navbar navbar-expand-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col">
                    <a class="navbar-brand logo text-rojo" href="<?= Parametros::$URL_BASE ?>">Apunta Todo</a>
                </div>
                <div class="col">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Parametros::$URL_BASE ?>">Inicio</a>
                    </li>
                    <?php if (Authentication::usuarioLoggeado()) : ?>
                        <li class="nav-item dropdown" data-bs-theme="dark">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTareas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tareas</a>
                            <ul class="dropdown-menu bg-verde-medio rounded" aria-labelledby="navbarDropdownTareas">
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Tarea/tareasUsuario">Tus tareas</a></li>
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Tarea/crear">Crear Tarea</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" data-bs-theme="dark">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Notas</a>
                            <ul class="dropdown-menu bg-verde-medio" aria-labelledby="navbarDropdownNotas">
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Nota/notasUsuario">Tus notas</a></li>
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Nota/crear">Crear Nota</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" data-bs-theme="dark">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">Grupos</a>
                            <ul class="dropdown-menu bg-verde-medio" aria-labelledby="navbarDropdownUsuario">
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Grupo/gruposUsuario">Tus grupos</a></li>
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Grupo/unirse">Unirse a un grupo</a></li>

                                <?php if (Authentication::isUserAdminLogged()) : ?>
                                    <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Grupo/crear">Crear grupos</a></li>

                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" data-bs-theme="dark">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuario</a>
                            <ul class="dropdown-menu bg-verde-medio" aria-labelledby="navbarDropdownUsuario">
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Usuario/mostrarPerfil">Tu perfil</a></li>
                                <li><a class="dropdown-item text-blanco desplegable" href="<?= Parametros::$URL_BASE ?>Usuario/cerrar">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Parametros::$URL_BASE ?>Usuario/mostrarRegistro">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Parametros::$URL_BASE ?>Usuario/mostrarInicioSesion">Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <!-- <div class="clearfix"></div> -->
    <div id="contenedor">
</body>

</html>