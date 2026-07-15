<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-distracciones">

    <section class="distracciones-hero">
        <h1>Distracciones</h1>
        <p>Registra las páginas que suelen distraerte durante el estudio.</p>
    </section>

    <section class="distracciones-contenido">

    <form id="form-crear-distraccion" class="distracciones-form-row" action="index.php?ruta=crear_distraccion" method="POST">
        <div class="bloque-url">
            <input type="text" name="nombre" placeholder="Nombre del sitio" required>
            <input type="text" name="url" placeholder="https://www.ejemplo.com" required>
        </div>

        <button type="submit" class="btn-principal">Añadir</button>
    </form>

    <h2>Páginas bloqueadas</h2>

    <div class="distracciones-lista-row">

    <div class="distracciones-bloque-lista">

        <?php if (empty($sitios)): ?>

            <p class="texto-muted">
                No tienes sitios registrados.
            </p>

        <?php else: ?>

            <?php foreach ($sitios as $index => $sitio): ?>
                <button
                    type="button"
                    class="distraccion-item <?php echo $index === 0 ? 'activa' : ''; ?>"
                    data-id="<?php echo $sitio["id"]; ?>"
                >
                    <span>
                        <strong><?php echo htmlspecialchars($sitio["nombre"]); ?></strong>
                        <?php echo htmlspecialchars($sitio["url"]); ?>
                    </span>

                    <?php if ($sitio["activo"]): ?>
                        <em class="estado-distraccion activo">Activo</em>
                    <?php else: ?>
                        <em class="estado-distraccion inactivo">Inactivo</em>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <div class="distracciones-acciones">
        <a id="btn-eliminar-distraccion" class="btn-secundario" href="#">
            Eliminar
        </a>

        <a id="btn-activar-distraccion" class="btn-principal" href="#">
            Activar
        </a>

        <a id="btn-desactivar-distraccion" class="btn-secundario" href="#">
            Desactivar
        </a>
    </div>

</div>

</section>

</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const formCrear = document.getElementById("form-crear-distraccion");
    const lista = document.querySelector(".distracciones-bloque-lista");

    const btnEliminar = document.getElementById("btn-eliminar-distraccion");
    const btnActivar = document.getElementById("btn-activar-distraccion");
    const btnDesactivar = document.getElementById("btn-desactivar-distraccion");

    let sitioSeleccionado = document.querySelector(".distraccion-item")
        ? document.querySelector(".distraccion-item").dataset.id
        : null;

    function actualizarBotones() {
        const haySeleccion = sitioSeleccionado !== null;

        [btnEliminar, btnActivar, btnDesactivar].forEach(btn => {
            if (!btn) return;
            btn.classList.toggle("disabled", !haySeleccion);
        });
    }

    function seleccionar(item) {
        sitioSeleccionado = item.dataset.id;

        document.querySelectorAll(".distraccion-item").forEach(i => {
            i.classList.remove("activa");
        });

        item.classList.add("activa");

        actualizarBotones();
    }

    if (sitioSeleccionado) {
        const primerItem = document.querySelector(".distraccion-item");
        if (primerItem) {
            seleccionar(primerItem);
        }
    } else {
        actualizarBotones();
    }

    document.addEventListener("click", async function (e) {
        const item = e.target.closest(".distraccion-item");

        if (item) {
            seleccionar(item);
        }

        if (e.target.closest("#btn-eliminar-distraccion")) {
            e.preventDefault();

            if (!sitioSeleccionado) return;

            if (!confirm("¿Eliminar este sitio bloqueado?")) {
                return;
            }

            const respuesta = await fetch("index.php?ruta=eliminar_distraccion_ajax", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(sitioSeleccionado)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                document
                    .querySelector('.distraccion-item[data-id="' + sitioSeleccionado + '"]')
                    ?.remove();

                const siguiente = document.querySelector(".distraccion-item");

                if (siguiente) {
                    seleccionar(siguiente);
                } else {
                    sitioSeleccionado = null;
                    lista.innerHTML = '<p class="texto-muted">No tienes sitios registrados.</p>';
                    actualizarBotones();
                }
            }
        }

        if (e.target.closest("#btn-activar-distraccion")) {
            e.preventDefault();

            if (!sitioSeleccionado) return;

            const respuesta = await fetch("index.php?ruta=activar_distraccion_ajax", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(sitioSeleccionado)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                const itemActual = document.querySelector('.distraccion-item[data-id="' + sitioSeleccionado + '"]');
                const estado = itemActual.querySelector(".estado-distraccion");

                estado.textContent = "Activo";
                estado.classList.remove("inactivo");
                estado.classList.add("activo");
            }
        }

        if (e.target.closest("#btn-desactivar-distraccion")) {
            e.preventDefault();

            if (!sitioSeleccionado) return;

            const respuesta = await fetch("index.php?ruta=desactivar_distraccion_ajax", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(sitioSeleccionado)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                const itemActual = document.querySelector('.distraccion-item[data-id="' + sitioSeleccionado + '"]');
                const estado = itemActual.querySelector(".estado-distraccion");

                estado.textContent = "Inactivo";
                estado.classList.remove("activo");
                estado.classList.add("inactivo");
            }
        }
    });

    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();

            const datos = new FormData(this);

            const respuesta = await fetch("index.php?ruta=crear_distraccion_ajax", {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.success) {
                const mensajeVacio = lista.querySelector(".texto-muted");
                if (mensajeVacio) {
                    mensajeVacio.remove();
                }

                const nuevo = document.createElement("button");
                nuevo.type = "button";
                nuevo.className = "distraccion-item";
                nuevo.dataset.id = resultado.id;

                nuevo.innerHTML = `
                    <span>
                        <strong>${resultado.nombre}</strong>
                        ${resultado.url}
                    </span>

                    <em class="estado-distraccion activo">Activo</em>
                `;

                lista.prepend(nuevo);

                seleccionar(nuevo);

                this.reset();
            }
        });
    }
});
</script>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>