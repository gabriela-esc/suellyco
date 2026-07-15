<?php

require_once __DIR__ . "/../modelos/Metrica.php";

class MetricaControlador
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

        $tiempo_hoy = Metrica::obtenerMinutosHoy($usuario_id);
        $tiempo_semana = Metrica::obtenerMinutosSemana($usuario_id);
        $tiempo_mes = Metrica::obtenerMinutosMes($usuario_id);
        $tiempo_total = Metrica::obtenerMinutosEstudiados($usuario_id);

        $sesiones_semana = Metrica::contarSesionesSemana($usuario_id);
        $sesiones_mes = Metrica::contarSesionesMes($usuario_id);

        $tareas_completadas = Metrica::contarTareasCompletadas($usuario_id);

        $progreso_listas = Metrica::obtenerProgresoPorLista($usuario_id);
        $historial = Metrica::obtenerHistorialDiario($usuario_id);

        require_once __DIR__ . "/../vistas/metricas/index.php";
    }
}