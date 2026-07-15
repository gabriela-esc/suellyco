<?php
$ruta_actual = $_GET["ruta"] ?? "inicio";

$clase_navbar = "navbar-home";

if ($ruta_actual === "perfil") {
    $clase_navbar .= " navbar-interna";
}

if (in_array($ruta_actual, ["registro", "registrarse", "guardar_registro"])) {
    $clase_navbar .= " navbar-registro";
}
?>

<nav class="<?php echo $clase_navbar; ?>">

    <div class="nav-izquierda">
        <a href="index.php?ruta=tareas">Tareas</a>
        <a href="index.php?ruta=distracciones">Distracciones</a>
        <a href="index.php?ruta=sesion">Sesión</a>
    </div>

    <a href="index.php?ruta=inicio" class="nav-logo">
        <img src="assets/img/logo_blanco.png" alt="Suellyco">
    </a>

    <div class="nav-derecha">

        <?php if (isset($_SESSION["usuario_id"])): ?>

            <a href="index.php?ruta=metricas">Métricas</a>
            <a href="index.php?ruta=perfil" class="activo">Perfil</a>
            <a href="index.php?ruta=cerrar_sesion" class="btn-salir">Salir</a>

        <?php else: ?>

            <a href="index.php?ruta=login" class="activo">Iniciar sesión</a>
            <a href="index.php?ruta=registro" class="btn-salir">Registrarse</a>

        <?php endif; ?>

    </div>

    <button class="menu-toggle" id="menu-toggle">☰</button>

    <div class="nav-mobile" id="nav-mobile">

        <a href="index.php?ruta=tareas">Tareas</a>
        <a href="index.php?ruta=distracciones">Distracciones</a>
        <a href="index.php?ruta=sesion">Sesión</a>

        <?php if (isset($_SESSION["usuario_id"])): ?>

            <a href="index.php?ruta=metricas">Métricas</a>
            <a href="index.php?ruta=perfil" class="btn-perfil">Perfil</a>
            <a href="index.php?ruta=cerrar_sesion" class="btn-salir">Salir</a>

        <?php else: ?>

            <a href="index.php?ruta=login" class="btn-perfil">Iniciar sesión</a>
            <a href="index.php?ruta=registro" class="btn-salir">Registrarse</a>

        <?php endif; ?>

    </div>

</nav>