<?php

class Conexion
{
    public static function conectar()
    {
        $esLocal = in_array(
            $_SERVER['HTTP_HOST'] ?? '',
            ['localhost', '127.0.0.1']
        );

        if ($esLocal) {
            $host = 'localhost';
            $base_datos = 'suellyco';
            $usuario = 'root';
            $contrasena = '';
        } else {
            $rutaCredenciales = __DIR__ . '/credenciales.php';

            if (!file_exists($rutaCredenciales)) {
                die('Falta el archivo de configuración del servidor.');
            }

            $credenciales = require $rutaCredenciales;

            $host = $credenciales['host'];
            $base_datos = $credenciales['base_datos'];
            $usuario = $credenciales['usuario'];
            $contrasena = $credenciales['contrasena'];
        }

        try {
            $conexion = new PDO(
                "mysql:host=$host;dbname=$base_datos;charset=utf8mb4",
                $usuario,
                $contrasena
            );

            $conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexion;
        } catch (PDOException $e) {
            die('Error al conectar con la base de datos.');
        }
    }
}