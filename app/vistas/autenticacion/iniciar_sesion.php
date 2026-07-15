<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="auth-simple">

    <section class="auth-formulario">

        <h1>Iniciar sesión</h1>

        <p class="auth-subtitulo">
            Accede a tu espacio de estudio en Suellyco.
        </p>

        <?php if (isset($_SESSION["error"])): ?>
            <p class="mensaje-error">
                <?php
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
                ?>
            </p>
        <?php endif; ?>

        <form class="form-auth" action="index.php?ruta=iniciar_sesion" method="POST">

            <input
                type="email"
                name="correo"
                placeholder="Correo electrónico"
                required
            >

            <input
                type="password"
                name="contrasena"
                placeholder="Contraseña"
                required
            >

            <button type="submit" class="btn-principal">
                Entrar
            </button>

        </form>

        <a class="auth-link" href="index.php?ruta=registro">
            Crear cuenta
        </a>

    </section>

</main>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("form-sesion");
    const error = document.getElementById("error-sesion-js");

    if (!form || !error) return;

    form.addEventListener("submit", function (e) {

        const nombreSesion = form.querySelector('[name="nombre_sesion"]');

        if (nombreSesion.value.trim() === "") {

            e.preventDefault();

            error.textContent =
                "Debes introducir un nombre para la sesión.";

            error.style.display = "block";

            return;
        }

        error.style.display = "none";
    });

});
</script>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>