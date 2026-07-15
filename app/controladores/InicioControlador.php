<?php

class InicioControlador
{
    public function index()
    {
        if (isset($_SESSION["usuario_id"])) {
            require_once "../app/vistas/inicio/usuario.php";
        } else {
            require_once "../app/vistas/inicio/invitado.php";
        }
    }
}