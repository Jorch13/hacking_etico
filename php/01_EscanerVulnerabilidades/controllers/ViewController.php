<?php

/**
 * Class ViewController
 * Controlador para gestionar la visualización de vistas.
 */
class ViewController
{
    /**
     * Muestra una vista específica.
     *
     * @param string|null $nombreVista Ruta de la vista a mostrar.
     * @param mixed|null $datos Datos a pasar a la vista.
     * @return void
     */
    public static function mostrar($nombreVista = null, $datos = null)
    {
        // self::mostrarCabecera();
        // self::mostrarLateral(); // Activar si es necesario mostrar el menú lateral
        require_once $nombreVista;
        // self::mostrarPie();
    }

    /**
     * Muestra una vista de error específica.
     *
     * @param string $error Nombre del método de error a mostrar.
     * @return void
     */
    public static function mostrarError($error)
    {
        self::mostrarCabecera();
        // self::mostrarLateral(); // Activar si es necesario mostrar el menú lateral
        $metodoError = "mostrar" . ucfirst($error); // Convierte el nombre del error a CamelCase
        // (new ErrorControlador())->$metodoError();
        self::mostrarPie();
    }

    /**
     * Muestra la cabecera de la página.
     *
     * @return void
     */
    public static function mostrarCabecera()
    {
        include '../public/layouts/header.php';
    }

    /**
     * Muestra el pie de la página.
     *
     * @return void
     */
    public static function mostrarPie()
    {
        include '../public/layouts/footer.php';
    }

    /**
     * Muestra el menú lateral de la página.
     *
     * @return void
     */
    public static function mostrarLateral()
    {
        include '../public/layouts/sidebar.php';
    }
}
