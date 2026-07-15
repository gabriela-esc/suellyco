<?php

require_once __DIR__ . "/../modelos/SitioBloqueado.php";

class DistraccionControlador
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
        $sitios = SitioBloqueado::obtenerPorUsuario($usuario_id);

        require_once __DIR__ . "/../vistas/distracciones/index.php";
    }

    public function crear()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = trim($_POST["nombre"]);
            $url = trim($_POST["url"]);

            if (!empty($nombre) && !empty($url)) {
                SitioBloqueado::crear($_SESSION["usuario_id"], $nombre, $url);
            }

            header("Location: index.php?ruta=distracciones");
            exit;
        }
    }

    public function cambiarEstado()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            SitioBloqueado::cambiarEstado($_GET["id"], $_SESSION["usuario_id"]);
        }

        header("Location: index.php?ruta=distracciones");
        exit;
    }

    public function eliminar()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            SitioBloqueado::eliminar($_GET["id"], $_SESSION["usuario_id"]);
        }

        header("Location: index.php?ruta=distracciones");
        exit;
    }
    public function crearAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    $nombre = trim($_POST["nombre"] ?? "");
    $url = trim($_POST["url"] ?? "");

    if (empty($nombre) || empty($url)) {
        echo json_encode(["success" => false]);
        exit;
    }

    $id = SitioBloqueado::crear($_SESSION["usuario_id"], $nombre, $url);

    echo json_encode([
        "success" => true,
        "id" => $id,
        "nombre" => $nombre,
        "url" => $url,
        "activo" => 1
    ]);

    exit;
}

public function eliminarAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    if (!isset($_POST["id"])) {
        echo json_encode(["success" => false]);
        exit;
    }

    SitioBloqueado::eliminar($_POST["id"], $_SESSION["usuario_id"]);

    echo json_encode(["success" => true]);
    exit;
}

public function activarAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    if (!isset($_POST["id"])) {
        echo json_encode(["success" => false]);
        exit;
    }

    SitioBloqueado::activar($_POST["id"], $_SESSION["usuario_id"]);

    echo json_encode(["success" => true, "activo" => 1]);
    exit;
}

public function desactivarAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    if (!isset($_POST["id"])) {
        echo json_encode(["success" => false]);
        exit;
    }

    SitioBloqueado::desactivar($_POST["id"], $_SESSION["usuario_id"]);

    echo json_encode(["success" => true, "activo" => 0]);
    exit;
}
}