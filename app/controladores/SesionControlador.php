<?php

require_once __DIR__ . "/../modelos/SesionEstudio.php";
require_once __DIR__ . "/../modelos/ListaTarea.php";
require_once __DIR__ . "/../modelos/SesionTarea.php";

class SesionControlador
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

    $usuario_id = $_SESSION["usuario_id"];

    $sesion_activa = SesionEstudio::obtenerActiva($usuario_id);
    $ultima_sesion = SesionEstudio::obtenerUltima($usuario_id);

    $tareas_sesion = [];

    if ($sesion_activa) {
        $tareas_sesion = SesionTarea::obtenerPorSesion($sesion_activa["id"]);
    }

    require_once __DIR__ . "/../vistas/sesion/index.php";
}

    public function nueva()
    {
        $this->verificarSesion();

        $usuario_id = $_SESSION["usuario_id"];
        $listas = ListaTarea::obtenerPorUsuario($usuario_id);

        require_once __DIR__ . "/../vistas/sesion/nueva.php";
    }

    public function crear()
{
    $this->verificarSesion();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $usuario_id = $_SESSION["usuario_id"];

        $lista_id = $_POST["lista_id"] ?? null;
        $nombre_sesion = trim($_POST["nombre_sesion"]);
        $minutos_estudio = (int) $_POST["minutos_estudio"];
        $minutos_descanso = (int) $_POST["minutos_descanso"];
        $sonido = $_POST["sonido"];
        $bloques = (int) $_POST["bloques"];

        if (!empty($nombre_sesion) && $minutos_estudio > 0) {
            $sesion_id = SesionEstudio::crear(
                $usuario_id,
                $lista_id,
                $nombre_sesion,
                $minutos_estudio,
                $minutos_descanso,
                $sonido,
                $bloques
            );

            if (!empty($lista_id)) {
                SesionTarea::asociarTareasDeLista($sesion_id, $lista_id);
            }
        }

        header("Location: index.php?ruta=sesion");
        exit;
    }
}

    public function finalizar()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            SesionEstudio::finalizar($_GET["id"], $_SESSION["usuario_id"]);
        }

        header("Location: index.php?ruta=sesion");
        exit;
    }

    public function finalizarAutomatica()
{
    $this->verificarSesion();

    if (isset($_GET["id"])) {
        SesionEstudio::finalizar(
            $_GET["id"],
            $_SESSION["usuario_id"]
        );
    }

    $_SESSION["exito"] = "La sesión ha finalizado automáticamente.";

    header("Location: index.php?ruta=sesion");
    exit;
}

    public function cancelar()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            SesionEstudio::cancelar($_GET["id"], $_SESSION["usuario_id"]);
        }

        header("Location: index.php?ruta=sesion");
        exit;
    }
    public function completarTareaSesion()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            SesionTarea::completar($_GET["id"]);
        }

        header("Location: index.php?ruta=sesion&recompensa=1");
        exit;
    }
}