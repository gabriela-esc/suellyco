<?php

$ruta = $_GET["ruta"] ?? "inicio";

switch ($ruta) {
    case "inicio":
        require_once __DIR__ . "/../app/controladores/InicioControlador.php";
        $controlador = new InicioControlador();
        $controlador->index();
        break;

    case "login":
        require_once __DIR__ . "/../app/controladores/AutenticacionControlador.php";
        $controlador = new AutenticacionControlador();
        $controlador->mostrarLogin();
        break;

    case "registro":
        require_once __DIR__ . "/../app/controladores/AutenticacionControlador.php";
        $controlador = new AutenticacionControlador();
        $controlador->mostrarRegistro();
        break;

    case "registrar":
    require_once __DIR__ . "/../app/controladores/AutenticacionControlador.php";
    $controlador = new AutenticacionControlador();
    $controlador->registrar();
    break;

    case "iniciar_sesion":
        require_once __DIR__ . "/../app/controladores/AutenticacionControlador.php";
        $controlador = new AutenticacionControlador();
        $controlador->iniciarSesion();
        break;

    case "cerrar_sesion":
        require_once __DIR__ . "/../app/controladores/AutenticacionControlador.php";
        $controlador = new AutenticacionControlador();
        $controlador->cerrarSesion();
        break;

        case "tareas":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->index();
    break;

case "crear_lista":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->crearLista();
    break;

case "crear_tarea":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->crearTarea();
    break;

case "completar_tarea":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->completarTarea();
    break;

case "eliminar_tarea":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->eliminarTarea();
    break;

    case "distracciones":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->index();
    break;

case "crear_distraccion":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->crear();
    break;

case "cambiar_estado_distraccion":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->cambiarEstado();
    break;

case "eliminar_distraccion":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->eliminar();
    break;

    case "sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->index();
    break;

case "nueva_sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->nueva();
    break;

case "crear_sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->crear();
    break;

case "finalizar_sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->finalizar();
    break;

case "finalizar_sesion_automatica":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->finalizarAutomatica();
    break;

case "cancelar_sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->cancelar();
    break;

case "completar_tarea_sesion":
    require_once __DIR__ . "/../app/controladores/SesionControlador.php";
    $controlador = new SesionControlador();
    $controlador->completarTareaSesion();
    break;

case "metricas":
    require_once __DIR__ . "/../app/controladores/MetricaControlador.php";
    $controlador = new MetricaControlador();
    $controlador->index();
    break;
case "perfil":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->index();
    break;

case "actualizar_perfil":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->actualizar();
    break;

case "cambiar_contrasena":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->cambiarContrasena();
    break;

case "actualizar_pomodoro":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->actualizarPomodoro();
    break;

case "actualizar_sonido":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->actualizarSonido();
    break;

case "eliminar_lista":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->eliminarLista();
    break;

    case "toggle_tarea":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->toggleTareaAjax();
    break;

    case "eliminar_tarea_ajax":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->eliminarTareaAjax();
    break;

    case "eliminar_lista_ajax":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->eliminarListaAjax();
    break;

    case "crear_lista_ajax":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->crearListaAjax();
    break;

case "crear_tarea_ajax":
    require_once __DIR__ . "/../app/controladores/TareaControlador.php";
    $controlador = new TareaControlador();
    $controlador->crearTareaAjax();
    break;

    case "crear_distraccion_ajax":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->crearAjax();
    break;

case "eliminar_distraccion_ajax":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->eliminarAjax();
    break;

case "activar_distraccion_ajax":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->activarAjax();
    break;

case "desactivar_distraccion_ajax":
    require_once __DIR__ . "/../app/controladores/DistraccionControlador.php";
    $controlador = new DistraccionControlador();
    $controlador->desactivarAjax();
    break;

    default:
        echo "Página no encontrada";
        break;

    case "eliminar_perfil":
    require_once __DIR__ . "/../app/controladores/PerfilControlador.php";
    $controlador = new PerfilControlador();
    $controlador->eliminarPerfil();
    break;
}