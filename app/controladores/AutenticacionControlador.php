<?php

require_once __DIR__ . "/../modelos/Usuario.php";

class AutenticacionControlador
{
    public function mostrarLogin()
    {
        require_once __DIR__ . "/../vistas/autenticacion/iniciar_sesion.php";
    }

    public function mostrarRegistro()
    {
        require_once __DIR__ . "/../vistas/autenticacion/registro.php";
    }

    public function registrar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = trim($_POST["nombre"]);
            $genero = $_POST["genero"] ?? "otro";
            $correo = trim($_POST["correo"]);
            $contrasena = $_POST["contrasena"];
            $confirmar_contrasena = $_POST["confirmar_contrasena"];

            if (empty($nombre) || empty($correo) || empty($contrasena)) {
                $_SESSION["error"] = "Todos los campos son obligatorios.";
                header("Location: index.php?ruta=registro");
                exit;
            }

            if ($contrasena !== $confirmar_contrasena) {
                $_SESSION["error"] = "Las contraseñas no coinciden.";
                header("Location: index.php?ruta=registro");
                exit;
            }

            if (Usuario::buscarPorCorreo($correo)) {
                $_SESSION["error"] = "El correo ya está registrado.";
                header("Location: index.php?ruta=registro");
                exit;
            }

            Usuario::crear($nombre, $genero, $correo, $contrasena);

            $_SESSION["exito"] = "Registro completado. Ahora puedes iniciar sesión.";
            header("Location: index.php?ruta=login");
            exit;
        }
    }

    public function iniciarSesion()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $correo = trim($_POST["correo"]);
            $contrasena = $_POST["contrasena"];

            $usuario = Usuario::buscarPorCorreo($correo);

            if (!$usuario || !password_verify($contrasena, $usuario["contrasena"])) {
                $_SESSION["error"] = "Correo o contraseña incorrectos.";
                header("Location: index.php?ruta=login");
                exit;
            }

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            $_SESSION["usuario_genero"] = $usuario["genero"];

            header("Location: index.php?ruta=inicio");
            exit;
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        header("Location: index.php?ruta=inicio");
        exit;
    }
}