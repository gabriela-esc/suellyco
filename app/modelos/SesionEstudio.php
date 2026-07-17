<?php

require_once __DIR__ . "/../../config/conexion.php";

class SesionEstudio
{
    public static function crear($usuario_id, $lista_id, $nombre_sesion, $minutos_estudio, $minutos_descanso, $sonido, $bloques)
{
    $conexion = Conexion::conectar();

    $sql = "INSERT INTO sesiones_estudio 
    (
        usuario_id,
        lista_id,
        nombre_sesion,
        minutos_estudio,
        minutos_descanso,
        sonido,
        bloques,
        bloque_actual,
        fase_actual,
        estado
    )
    VALUES 
    (
        :usuario_id,
        :lista_id,
        :nombre_sesion,
        :minutos_estudio,
        :minutos_descanso,
        :sonido,
        :bloques,
        1,
        'estudio',
        'activa'
    )";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":lista_id" => $lista_id ?: null,
        ":nombre_sesion" => $nombre_sesion,
        ":minutos_estudio" => $minutos_estudio,
        ":minutos_descanso" => $minutos_descanso,
        ":sonido" => $sonido,
        ":bloques" => $bloques
        
    ]);

    return $conexion->lastInsertId();
}

    public static function obtenerActiva($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT 
            se.*,
            UNIX_TIMESTAMP(se.fecha_inicio) AS fecha_inicio_unix,
            lt.nombre AS nombre_lista
        FROM sesiones_estudio se
        LEFT JOIN listas_tareas lt ON se.lista_id = lt.id
        WHERE se.usuario_id = :usuario_id
        AND se.estado = 'activa'
        ORDER BY se.fecha_inicio DESC
        LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerUltima($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT se.*, lt.nombre AS nombre_lista
                FROM sesiones_estudio se
                LEFT JOIN listas_tareas lt ON se.lista_id = lt.id
                WHERE se.usuario_id = :usuario_id
                AND se.estado != 'activa'
                ORDER BY se.fecha_fin DESC
                LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function finalizar($id, $usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE sesiones_estudio
                SET estado = 'completada',
                    fecha_fin = NOW(),
                    segundos_totales = TIMESTAMPDIFF(SECOND, fecha_inicio, NOW())
                WHERE id = :id 
                AND usuario_id = :usuario_id
                AND estado = 'activa'";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":usuario_id" => $usuario_id
        ]);
    }

    public static function cancelar($id, $usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE sesiones_estudio
                SET estado = 'cancelada',
                    fecha_fin = NOW(),
                    segundos_totales = TIMESTAMPDIFF(SECOND, fecha_inicio, NOW())
                WHERE id = :id 
                AND usuario_id = :usuario_id
                AND estado = 'activa'";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":usuario_id" => $usuario_id
        ]);
    }
}