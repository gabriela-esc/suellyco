<?php

require_once __DIR__ . "/../../config/conexion.php";

class ListaTarea
{
    public static function crear($usuario_id, $nombre, $descripcion)
{
    $conexion = Conexion::conectar();

    $sql = "INSERT INTO listas_tareas (usuario_id, nombre, descripcion)
            VALUES (:usuario_id, :nombre, :descripcion)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":nombre" => $nombre,
        ":descripcion" => $descripcion
    ]);

    return $conexion->lastInsertId();
}

    public static function obtenerPorUsuario($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM listas_tareas
                WHERE usuario_id = :usuario_id
                ORDER BY fecha_creacion DESC";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorId($id, $usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM listas_tareas
                WHERE id = :id AND usuario_id = :usuario_id
                LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":id" => $id,
            ":usuario_id" => $usuario_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function eliminar($id, $usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "DELETE FROM listas_tareas
            WHERE id = :id AND usuario_id = :usuario_id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":id" => $id,
        ":usuario_id" => $usuario_id
    ]);
}
}