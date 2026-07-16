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
            $host = 'sql205.infinityfree.com';
            $base_datos = 'if0_42426723_suellyco';
            $usuario = 'if0_42426723';
            $contrasena = 'KocjgCqhuyEkT';
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