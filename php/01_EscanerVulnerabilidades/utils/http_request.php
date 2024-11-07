<?php
class HttpRequest
{
    /**
     * Realiza una solicitud HTTP GET a la URL especificada.
     * 
     * @param string $url La URL a la que se enviará la solicitud.
     * @param array $headers Opcional, array de encabezados personalizados.
     * @return string|false La respuesta del servidor o false en caso de error.
     */
    public static function get($url, $headers = [])
    {
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => self::formatHeaders($headers),
                'timeout' => 10, // Tiempo de espera para la solicitud
            ]
        ];

        $context = stream_context_create($options);

        // Intentar obtener la respuesta
        $response = @file_get_contents($url, false, $context);
        if ($response === FALSE) {
            // Si falla, puedes registrar el error o hacer algo más
            Logger::log("Error al obtener la URL: $url");
            return false;
        }

        return $response;
    }

    /**
     * Realiza una solicitud HTTP POST a la URL especificada.
     * 
     * @param string $url La URL a la que se enviará la solicitud.
     * @param array $data Datos a enviar en el cuerpo de la solicitud.
     * @param array $headers Opcional, array de encabezados personalizados.
     * @return string|false La respuesta del servidor o false en caso de error.
     */
    public static function post($url, $data, $headers = [])
    {
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => self::formatHeaders($headers, true),
                'content' => http_build_query($data),
                'timeout' => 10, // Tiempo de espera para la solicitud
            ]
        ];

        $context = stream_context_create($options);

        // Intentar obtener la respuesta
        $response = @file_get_contents($url, false, $context);
        if ($response === FALSE) {
            // Si falla, puedes registrar el error o hacer algo más
            Logger::log("Error al realizar POST a la URL: $url");
            return false;
        }

        return $response;
    }

    /**
     * Formatea los encabezados para su uso en la solicitud HTTP.
     * 
     * @param array $headers Array de encabezados.
     * @param bool $isPost Define si es una solicitud POST para añadir el tipo de contenido.
     * @return string Encabezados formateados.
     */
    private static function formatHeaders($headers, $isPost = false)
    {
        $defaultHeaders = [];

        if ($isPost) {
            $defaultHeaders[] = 'Content-Type: application/x-www-form-urlencoded';
        }

        foreach ($headers as $key => $value) {
            $defaultHeaders[] = "$key: $value";
        }

        return implode("\r\n", $defaultHeaders);
    }
}
