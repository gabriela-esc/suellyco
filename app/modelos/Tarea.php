<?php

require_once __DIR__ . "/../../config/conexion.php";

class Tarea
{
    public static function crear($lista_id, $nombre, $descripcion)
{
    $conexion = Conexion::conectar();

    $sql = "INSERT INTO tareas (lista_id, nombre, descripcion)
            VALUES (:lista_id, :nombre, :descripcion)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":lista_id" => $lista_id,
        ":nombre" => $nombre,
        ":descripcion" => $descripcion
    ]);

    return $conexion->lastInsertId();
}

    public static function obtenerPorLista($lista_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM tareas
                WHERE lista_id = :lista_id
                ORDER BY fecha_creacion DESC";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":lista_id" => $lista_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function completar($id)
{
    $conexion = Conexion::conectar();

    $sql = "UPDATE tareas
            SET completada = CASE
                    WHEN completada = 1 THEN 0
                    ELSE 1
                END,
                fecha_completada = CASE
                    WHEN completada = 1 THEN NULL
                    ELSE NOW()
                END
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":id" => $id
    ]);
}

    public static function eliminar($id)
    {
        $conexion = Conexion::conectar();

        $sql = "DELETE FROM tareas WHERE id = :id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}