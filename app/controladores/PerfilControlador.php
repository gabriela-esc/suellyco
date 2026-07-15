<?php

require_once __DIR__ . "/../modelos/Usuario.php";
require_once __DIR__ . "/../modelos/PreferenciaUsuario.php";

class PerfilControlador
{
    private function verificarSesion()
    {
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: index.php?ruta=login");
            exit;
        }
    }

    public function index()
    {
        $this->verificarSesion();

        $usuario = Usuario::buscarPorId($_SESSION["usuario_id"]);
        $preferencias = PreferenciaUsuario::obtenerPorUsuario($_SESSION["usuario_id"]);

        require_once __DIR__ . "/../vistas/perfil/index.php";
    }

    public function actualizar()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_SESSION["usuario_id"];
            $nombre = trim($_POST["nombre"]);
            $genero = trim($_POST["genero"]);
            $correo = trim($_POST["correo"]);

            if (!empty($nombre) && !empty($correo)) {
                Usuario::actualizarPerfil($id, $nombre, $genero, $correo);
                $_SESSION["usuario_nombre"] = $nombre;
                $_SESSION["usuario_genero"] = $genero;
                $_SESSION["exito"] = "Perfil actualizado correctamente.";
            } else {
                $_SESSION["error"] = "Nombre y correo son obligatorios.";
            }

            header("Location: index.php?ruta=perfil");
            exit;
        }
    }

    public function cambiarContrasena()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_SESSION["usuario_id"];
            $nueva_contrasena = $_POST["nueva_contrasena"];
            $confirmar_contrasena = $_POST["confirmar_contrasena"];

            if (empty($nueva_contrasena) || empty($confirmar_contrasena)) {
                $_SESSION["error"] = "Completa ambos campos de contraseña.";
            } elseif ($nueva_contrasena !== $confirmar_contrasena) {
                $_SESSION["error"] = "Las contraseñas no coinciden.";
            } else {
                Usuario::cambiarContrasena($id, $nueva_contrasena);
                $_SESSION["exito"] = "Contraseña actualizada correctamente.";
            }

            header("Location: index.php?ruta=perfil");
            exit;
        }
    }

    public function actualizarPomodoro()
{
    $this->verificarSesion();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $minutos_estudio = (int) $_POST["minutos_estudio"];
        $minutos_descanso = (int) $_POST["minutos_descanso"];

        if ($minutos_estudio > 0 && $minutos_descanso > 0) {
            PreferenciaUsuario::actualizarPomodoro(
                $_SESSION["usuario_id"],
                $minutos_estudio,
                $minutos_descanso
            );

            $_SESSION["exito"] = "Preferencias actualizadas correctamente.";
        } else {
            $_SESSION["error"] = "Los minutos deben ser mayores que cero.";
        }

        header("Location: index.php?ruta=perfil");
        exit;
        }
    }

    public function actualizarSonido()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $sonido_favorito = $_POST["sonido_favorito"];

            PreferenciaUsuario::actualizarSonido(
                $_SESSION["usuario_id"],
                $sonido_favorito
            );

            $_SESSION["exito"] = "Sonido favorito actualizado correctamente.";

            header("Location: index.php?ruta=perfil");
            exit;
        }
    }

    public function eliminarPerfil()
{
    $this->verificarSesion();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_SESSION["usuario_id"];

        if (Usuario::eliminarCuenta($id)) {
            session_unset();
            session_destroy();

            header("Location: index.php?ruta=inicio");
            exit;
        }

        $_SESSION["error"] = "No se pudo eliminar la cuenta.";
        header("Location: index.php?ruta=perfil");
        exit;
    }

    header("Location: index.php?ruta=perfil");
    exit;
}

}
