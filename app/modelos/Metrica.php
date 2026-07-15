<?php

require_once __DIR__ . "/../../config/conexion.php";

class Metrica
{
    public static function contarSesionesCompletadas($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COUNT(*) AS total
                FROM sesiones_estudio
                WHERE usuario_id = :usuario_id
                AND estado = 'completada'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([":usuario_id" => $usuario_id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado["total"] ?? 0;
    }

    public static function obtenerMinutosEstudiados($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COALESCE(SUM(segundos_totales), 0) AS total_segundos
                FROM sesiones_estudio
                WHERE usuario_id = :usuario_id
                AND estado = 'completada'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([":usuario_id" => $usuario_id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return round(($resultado["total_segundos"] ?? 0) / 60);
    }

    public static function contarTareasCompletadas($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COUNT(*) AS total
                FROM tareas t
                INNER JOIN listas_tareas lt ON t.lista_id = lt.id
                WHERE lt.usuario_id = :usuario_id
                AND t.completada = 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([":usuario_id" => $usuario_id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado["total"] ?? 0;
    }

    public static function contarDistracciones($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COUNT(*) AS total
                FROM sitios_bloqueados
                WHERE usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([":usuario_id" => $usuario_id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado["total"] ?? 0;
    }

    public static function obtenerUltimasSesiones($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT nombre_sesion, estado, segundos_totales, fecha_inicio, fecha_fin
                FROM sesiones_estudio
                WHERE usuario_id = :usuario_id
                ORDER BY fecha_inicio DESC
                LIMIT 10";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([":usuario_id" => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public static function obtenerMinutosHoy($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COALESCE(SUM(segundos_totales), 0) AS total
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND estado = 'completada'
            AND DATE(fecha_inicio) = CURDATE()";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return round(($stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0) / 60);
}

public static function obtenerMinutosSemana($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COALESCE(SUM(segundos_totales), 0) AS total
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND estado = 'completada'
            AND YEARWEEK(fecha_inicio, 1) = YEARWEEK(CURDATE(), 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return round(($stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0) / 60);
}

public static function obtenerMinutosMes($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COALESCE(SUM(segundos_totales), 0) AS total
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND estado = 'completada'
            AND MONTH(fecha_inicio) = MONTH(CURDATE())
            AND YEAR(fecha_inicio) = YEAR(CURDATE())";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return round(($stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0) / 60);
}

public static function contarSesionesSemana($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COUNT(*) AS total
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND YEARWEEK(fecha_inicio, 1) = YEARWEEK(CURDATE(), 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;
}

public static function contarSesionesMes($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COUNT(*) AS total
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND MONTH(fecha_inicio) = MONTH(CURDATE())
            AND YEAR(fecha_inicio) = YEAR(CURDATE())";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;
}

public static function obtenerProgresoPorLista($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT 
                lt.nombre,
                COUNT(t.id) AS total_tareas,
                SUM(CASE WHEN t.completada = 1 THEN 1 ELSE 0 END) AS completadas
            FROM listas_tareas lt
            LEFT JOIN tareas t ON t.lista_id = lt.id
            WHERE lt.usuario_id = :usuario_id
            GROUP BY lt.id
            ORDER BY lt.fecha_creacion DESC
            LIMIT 6";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function obtenerHistorialDiario($usuario_id)
{
    $conexion = Conexion::conectar();

    $sql = "SELECT 
                DATE(fecha_inicio) AS fecha,
                ROUND(SUM(segundos_totales) / 60) AS minutos
            FROM sesiones_estudio
            WHERE usuario_id = :usuario_id
            AND estado = 'completada'
            GROUP BY DATE(fecha_inicio)
            ORDER BY fecha_inicio DESC
            LIMIT 6";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":usuario_id" => $usuario_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}