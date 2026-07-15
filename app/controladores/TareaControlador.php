<?php

require_once __DIR__ . "/../modelos/ListaTarea.php";
require_once __DIR__ . "/../modelos/Tarea.php";

class TareaControlador
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
        $listas = ListaTarea::obtenerPorUsuario($usuario_id);

        require_once __DIR__ . "/../vistas/tareas/index.php";
    }

    public function crearLista()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = trim($_POST["nombre"]);
            $descripcion = trim($_POST["descripcion"] ?? "");

            if (!empty($nombre)) {
                ListaTarea::crear($_SESSION["usuario_id"], $nombre, $descripcion);
            }

            header("Location: index.php?ruta=tareas");
            exit;
        }
    }

    public function crearTarea()
    {
        $this->verificarSesion();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lista_id = $_POST["lista_id"];
            $nombre = trim($_POST["nombre"]);
            $descripcion = trim($_POST["descripcion"] ?? "");

            $lista = ListaTarea::obtenerPorId($lista_id, $_SESSION["usuario_id"]);

            if ($lista && !empty($nombre)) {
                Tarea::crear($lista_id, $nombre, $descripcion);
            }

            header("Location: index.php?ruta=tareas");
            exit;
        }
    }

    public function completarTarea()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            Tarea::completar($_GET["id"]);
        }

        header("Location: index.php?ruta=tareas");
        exit;
    }

    public function eliminarTarea()
    {
        $this->verificarSesion();

        if (isset($_GET["id"])) {
            Tarea::eliminar($_GET["id"]);
        }

        header("Location: index.php?ruta=tareas");
        exit;
    }

    public function eliminarLista()
{
    $this->verificarSesion();

    if (isset($_GET["id"])) {
        ListaTarea::eliminar($_GET["id"], $_SESSION["usuario_id"]);
    }

    header("Location: index.php?ruta=tareas");
    exit;
}

public function toggleTareaAjax()
{
    $this->verificarSesion();

    if (isset($_POST["id"])) {

        Tarea::completar($_POST["id"]);

        echo json_encode([
            "success" => true
        ]);

        exit;
    }

    echo json_encode([
        "success" => false
    ]);

    exit;
}

public function eliminarTareaAjax()
{
    $this->verificarSesion();

    header('Content-Type: application/json');

    if (!isset($_POST["id"])) {
        echo json_encode(["success" => false]);
        exit;
    }

    Tarea::eliminar($_POST["id"]);

    echo json_encode([
        "success" => true
    ]);

    exit;
}

public function eliminarListaAjax()
{
    $this->verificarSesion();

    header('Content-Type: application/json');

    if (!isset($_POST["id"])) {
        echo json_encode(["success" => false]);
        exit;
    }

    ListaTarea::eliminar(
        $_POST["id"],
        $_SESSION["usuario_id"]
    );

    echo json_encode([
        "success" => true
    ]);

    exit;
}

public function crearListaAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($nombre)) {
        echo json_encode(["success" => false]);
        exit;
    }

    $id = ListaTarea::crear($_SESSION["usuario_id"], $nombre, $descripcion);

    echo json_encode([
        "success" => true,
        "id" => $id,
        "nombre" => $nombre,
        "descripcion" => $descripcion
    ]);

    exit;
}

public function crearTareaAjax()
{
    $this->verificarSesion();

    header("Content-Type: application/json");

    $lista_id = $_POST["lista_id"] ?? null;
    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($lista_id) || empty($nombre)) {
        echo json_encode(["success" => false]);
        exit;
    }

    $lista = ListaTarea::obtenerPorId($lista_id, $_SESSION["usuario_id"]);

    if (!$lista) {
        echo json_encode(["success" => false]);
        exit;
    }

    $id = Tarea::crear($lista_id, $nombre, $descripcion);

    echo json_encode([
        "success" => true,
        "id" => $id,
        "lista_id" => $lista_id,
        "nombre" => $nombre,
        "descripcion" => $descripcion
    ]);

    exit;
}



}