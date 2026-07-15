<?php

require_once __DIR__ . "/../../config/conexion.php";

class PreferenciaUsuario
{
    public static function obtenerPorUsuario($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM preferencias_usuario
                WHERE usuario_id = :usuario_id
                LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);

        $preferencias = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$preferencias) {
            self::crearPorDefecto($usuario_id);

            return self::obtenerPorUsuario($usuario_id);
        }

        return $preferencias;
    }

    public static function crearPorDefecto($usuario_id)
    {
        $conexion = Conexion::conectar();

        $sql = "INSERT INTO preferencias_usuario
                (usuario_id, minutos_estudio, minutos_descanso, sonido_favorito)
                VALUES (:usuario_id, 60, 15, 'spotify')";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":usuario_id" => $usuario_id
        ]);
    }

    public static function actualizarPomodoro($usuario_id, $minutos_estudio, $minutos_descanso)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE preferencias_usuario
                SET minutos_estudio = :minutos_estudio,
                    minutos_descanso = :minutos_descanso
                WHERE usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":usuario_id" => $usuario_id,
            ":minutos_estudio" => $minutos_estudio,
            ":minutos_descanso" => $minutos_descanso
        ]);
    }

    public static function actualizarSonido($usuario_id, $sonido_favorito)
    {
        $conexion = Conexion::conectar();

        $sql = "UPDATE preferencias_usuario
                SET sonido_favorito = :sonido_favorito
                WHERE usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":usuario_id" => $usuario_id,
            ":sonido_favorito" => $sonido_favorito
        ]);
    }
}