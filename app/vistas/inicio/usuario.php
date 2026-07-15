<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>

<main class="home">
    <video class="home-video" autoplay muted loop playsinline>
        <source src="assets/video/video_home.mp4" type="video/mp4">
    </video>

    <div class="home-overlay"></div>

    <?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>
    <?php
        $saludo = match ($_SESSION["usuario_genero"] ?? "otro") {
        "masculino" => "BIENVENIDO",
        "femenino" => "BIENVENIDA",
        default => "BIENVENIDE"
        };
    ?>
    <section class="home-contenido">
        <h1>
            <?php echo $saludo . " " . strtoupper(htmlspecialchars($_SESSION["usuario_nombre"])); ?>
        </h1>

        <p>Concentrate sin esfuerzo</p>

        <a href="index.php?ruta=sesion" class="btn-home">
            Empieza una nueva sesión
        </a>
    </section>
</main>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>