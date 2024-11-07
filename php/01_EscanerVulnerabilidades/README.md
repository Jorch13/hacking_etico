# Proyecto de Escáner de Vulnerabilidades

## Descripción

Este proyecto consiste en un escáner de vulnerabilidades que analiza diferentes tipos de amenazas en aplicaciones web. A continuación, se presenta la estructura de las carpetas y archivos del proyecto.

## Estructura del Proyecto

### config/
- **config.php**: Contiene configuraciones generales, como la URL del sitio a escanear, credenciales de acceso, tiempo de espera para solicitudes HTTP, entre otros.

### core/
Contiene las clases y funciones principales que ejecutan los escaneos de vulnerabilidades:
- **scanner.php**: Clase principal que coordina las funciones de escaneo de vulnerabilidades. Incluye una función principal `runScan()` que llama a cada clase específica de vulnerabilidad.
- **sql_injection.php**: Clase que prueba la inyección SQL simulando intentos en parámetros comunes.
- **xss_detection.php**: Detecta posibles entradas XSS probando campos de entrada con scripts comunes.
- **csrf_detection.php**: Comprueba si la página tiene protección CSRF revisando tokens en formularios o en cookies.
- **directory_exposure.php**: Intenta acceder a rutas comunes (por ejemplo, `/admin`, `/backup`, `/config.php`) para verificar si hay archivos expuestos públicamente.

### utils/
Contiene utilidades para el escáner, como la realización de solicitudes HTTP, el manejo de logs y la generación de reportes:
- **http_request.php**: Define una función para hacer solicitudes HTTP (GET, POST) con soporte para parámetros y cabeceras personalizadas.
- **report.php**: Define una función para generar reportes, guardarlos en archivos o mostrarlos en pantalla.
- **logger.php**: Función para registrar logs de actividad durante el escaneo.

### public/
Contiene archivos de cara al usuario, útiles si deseas proporcionar una interfaz web simple o interactiva:
- **index.php**: Archivo principal que inicializa el escáner; puede servir como una interfaz CLI o UI.
- **style.css**: Archivo de estilos para la interfaz.
- **app.js**: Script JavaScript para agregar funcionalidad interactiva, como el manejo de respuestas del escáner en tiempo real.

### reports/
Almacena los reportes de vulnerabilidades generados por el escáner:
- **report_template.html**: Plantilla HTML para mostrar de forma clara los resultados de cada vulnerabilidad detectada.

## Cómo Usar

1. **Configuración**: Edita el archivo `config/config.php` para ajustar las configuraciones según tus necesidades.
2. **Ejecutar el Escáner**: Usa el archivo `public/index.php` para iniciar el escáner a través de la interfaz web o CLI.
3. **Ver Reportes**: Los reportes generados se almacenarán en la carpeta `reports/` y se pueden visualizar usando la plantilla `report_template.html`.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue para discutir cualquier cambio importante antes de realizarlo.

## Licencia

Este proyecto está licenciado bajo los términos de la licencia MIT. Consulta el archivo `LICENSE` para más detalles.
