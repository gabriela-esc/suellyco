<?php

require_once __DIR__ . "/../../config/conexion.php";

class Usuario
{
    public static function crear($nombre, $genero, $correo, $contrasena)
    {
        $conexion = Conexion::conectar();

        $sql = "INSERT INTO usuarios (nombre, genero, correo, contrasena)
                VALUES (:nombre, :genero, :correo, :contrasena)";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":genero" => $genero,
            ":correo" => $correo,
            ":contrasena" => password_hash($contrasena, PASSWORD_DEFAULT)
        ]);
    }

    public static function buscarPorCorreo($correo)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM usuarios WHERE correo = :correo LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":correo" => $correo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT id, nombre, genero, correo, fecha_creacion
                FROM usuarios
                WHERE id = :id
                LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizarPerfil($id, $nombre, $genero, $correo)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    genero = :genero,
                    correo = :correo
                WHERE id = :id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":genero" => $genero,
            ":nombre" => $nombre,
            ":correo" => $correo
        ]);
    }

    public static function cambiarContrasena($id, $nueva_contrasena)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE usuarios
                SET contrasena = :contrasena
                WHERE id = :id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":contrasena" => password_hash($nueva_contrasena, PASSWORD_DEFAULT)
        ]);
    }

    public static function eliminarCuenta($id)
{
    $conexion = Conexion::conectar();

    $sql = "DELETE FROM usuarios WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":id" => $id
    ]);
}

}