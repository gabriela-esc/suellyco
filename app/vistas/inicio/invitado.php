<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>

<main class="home">
    <video class="home-video" autoplay muted loop playsinline>
        <source src="assets/video/video_home.mp4" type="video/mp4">
    </video>

    <div class="home-overlay"></div>

    <?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

    <section class="home-contenido">
        <h1>BIENVENIDO</h1>

        <p>Organiza tu estudio, reduce distracciones y mantén el foco.</p>
    </section>
</main>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>