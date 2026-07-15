<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>

<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="registro-simple">

    <section class="registro-formulario">

        <h1>Registro</h1>

        <p class="registro-subtitulo">
            Empieza a organizar tu estudio con Suellyco.
        </p>

        <?php if (isset($_SESSION["error"])): ?>
            <p class="mensaje-error">
                <?php
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
                ?>
            </p>
        <?php endif; ?>

        <p id="error-registro-js" class="mensaje-error" style="display:none;"></p>
        <form id="form-registro" class="form-auth" action="index.php?ruta=registrar" method="POST" novalidate>

            <input type="text" name="nombre" placeholder="Nombre" required>

            <select name="genero" required>
                <option value="">Selecciona tu género</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>

            <input type="email" name="correo" placeholder="Correo electrónico" required>

            <input type="password" name="contrasena" placeholder="Contraseña" required>

            <input type="password" name="confirmar_contrasena" placeholder="Confirmar contraseña" required>

            <button type="submit" class="btn-principal">
                Registrarme
            </button>

        </form>

        <a class="auth-link" href="index.php?ruta=login">
            Ya tengo cuenta
        </a>

    </section>

</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-registro");
    const error = document.getElementById("error-registro-js");

    if (!form || !error) return;

    form.addEventListener("submit", function (e) {
        const campos = [
            { name: "nombre", label: "nombre" },
            { name: "genero", label: "género" },
            { name: "correo", label: "correo electrónico" },
            { name: "contrasena", label: "contraseña" },
            { name: "confirmar_contrasena", label: "confirmar contraseña" }
        ];

        const vacios = [];

        campos.forEach(campo => {
            const input = form.querySelector(`[name="${campo.name}"]`);

            if (!input || input.value.trim() === "") {
                vacios.push(campo.label);
            }
        });

        if (vacios.length > 0) {
            e.preventDefault();

            let mensaje = "";

            if (vacios.length === 1) {
                mensaje = "Debes rellenar el campo " + vacios[0] + ".";
            } else {
                const ultimo = vacios.pop();
                mensaje = "Debes rellenar los campos " + vacios.join(", ") + " y " + ultimo + ".";
            }

            error.textContent = mensaje;
            error.style.display = "block";

            return;
        }

        error.style.display = "none";
    });
});
</script>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>
