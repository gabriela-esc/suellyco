<?php

require_once __DIR__ . "/../../config/conexion.php";

class SesionTarea
{
    public static function asociarTareasDeLista($sesion_id, $lista_id)
    {
        $conexion = Conexion::conectar();

        $sql = "INSERT INTO sesiones_tareas (sesion_id, tarea_id)
                SELECT :sesion_id, id
                FROM tareas
                WHERE lista_id = :lista_id
                AND completada = 0";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":sesion_id" => $sesion_id,
            ":lista_id" => $lista_id
        ]);
    }

    public static function obtenerPorSesion($sesion_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT st.*, t.nombre, t.descripcion
                FROM sesiones_tareas st
                INNER JOIN tareas t ON st.tarea_id = t.id
                WHERE st.sesion_id = :sesion_id
                ORDER BY t.fecha_creacion ASC";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":sesion_id" => $sesion_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function completar($sesion_tarea_id)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE sesiones_tareas st
                INNER JOIN tareas t ON st.tarea_id = t.id
                SET st.completada = 1,
                    st.fecha_completada = NOW(),
                    t.completada = 1,
                    t.fecha_completada = NOW()
                WHERE st.id = :sesion_tarea_id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":sesion_tarea_id" => $sesion_tarea_id
        ]);
    }

    public static function contarCompletadas($sesion_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COUNT(*) AS total
                FROM sesiones_tareas
                WHERE sesion_id = :sesion_id
                AND completada = 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":sesion_id" => $sesion_id
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado["total"] ?? 0;
    }

    public static function contarTotal($sesion_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT COUNT(*) AS total
                FROM sesiones_tareas
                WHERE sesion_id = :sesion_id";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":sesion_id" => $sesion_id
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado["total"] ?? 0;
    }
}