<?php
/**
 * Created by PhpStorm.
 * User: Robert Grigoryan
 * Date: 8/1/2022
 * Time: 10:41 AM
 */

namespace App\Helpers;

class ServerNameHelper
{
    public static function server_name()
    {
        // Determine if the connection is secure
        $url_type = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        // Get the server name (e.g., '127.0.0.1' or 'localhost')
        $url_name = $_SERVER['SERVER_NAME'];

        // Get the port number
        $port = $_SERVER['SERVER_PORT'];

        // Append the port to the URL only if it's not the default HTTP or HTTPS port
        if (($url_type === 'http' && $port != '80') || ($url_type === 'https' && $port != '443')) {
            $url_name .= ':' . $port;
        }

        // Return the full URL
        return $url_type . '://' . $url_name;
    }
}
