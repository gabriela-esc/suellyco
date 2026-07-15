<?php

require_once __DIR__ . "/../../config/conexion.php";

class SitioBloqueado
{
    public static function crear($usuario_id, $nombre, $url)
{
    $conexion = Conexion::conectar();

    $sql = "INSERT INTO sitios_bloqueados (usuario_id, nombre, url)
            VALUES (:usuario_id, :nombre, :url)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":nombre" => $nombre,
        ":url" => $url
    ]);

    return $conexion->lastInsertId();
}

    public static function obtenerPorUsuario($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM sitios_bloqueados
                WHERE usuario_id = :usuario_id
                ORDER BY fecha_creacion DESC";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cambiarEstado($id, $usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE sitios_bloqueados
                SET activo = IF(activo = 1, 0, 1)
                WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":usuario_id" => $usuario_id
        ]);
    }

    public static function eliminar($id, $usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "DELETE FROM sitios_bloqueados
                WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":usuario_id" => $usuario_id
        ]);
    }

    public static function activar($id, $usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "UPDATE sitios_bloqueados
            SET activo = 1
            WHERE id = :id AND usuario_id = :usuario_id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":id" => $id,
        ":usuario_id" => $usuario_id
    ]);
}

public static function desactivar($id, $usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "UPDATE sitios_bloqueados
            SET activo = 0
            WHERE id = :id AND usuario_id = :usuario_id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":id" => $id,
        ":usuario_id" => $usuario_id
    ]);
}
}