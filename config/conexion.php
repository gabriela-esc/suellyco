<?php

class Conexion
{
    public static function conectar()
    {
        $host = "localhost";
        $base_datos = "suellyco";
        $usuario = "root";
        $contrasena = "";

        try {
            $conexion = new PDO(
                "mysql:host=$host;dbname=$base_datos;charset=utf8mb4",
                $usuario,
                $contrasena
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}