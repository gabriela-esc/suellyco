<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-tareas">

    <section class="tareas-hero">
        <span class="tareas-etiqueta">Organización</span>
        <h1>Tareas</h1>
        <p>No olvides dividir tus tareas en subtareas, será más fácil.</p>
    </section>

    <section class="tareas-layout">

        <article class="panel-tareas">
            <div class="panel-header">
                <h2>Listas</h2>
            </div>

            <div class="lista-scroll">
                <?php if (empty($listas)): ?>
                    <p class="texto-muted">Aún no tienes ninguna lista. Añade una.</p>
                <?php else: ?>
                    <?php foreach ($listas as $index => $lista): ?>
                        <button
                            type="button"
                            class="lista-item <?php echo $index === 0 ? 'activa' : ''; ?>"
                            data-lista-id="<?php echo $lista["id"]; ?>"
                        >
                            <span class="lista-nombre">
                                <?php echo htmlspecialchars($lista["nombre"]); ?>
                            </span>

                            <?php if (!empty($lista["descripcion"])): ?>
                                <span class="lista-descripcion">
                                    <?php echo htmlspecialchars($lista["descripcion"]); ?>
                                </span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="panel-acciones">
                <button type="button" class="btn-principal abrir-modal" data-modal="modal-lista">
                    Añadir
                </button>

                <?php if (!empty($listas)): ?>
                    <button type="button" id="btn-eliminar-lista" class="btn-secundario">
                        Eliminar
                    </button>
                <?php endif; ?>
            </div>
        </article>

        <article class="panel-tareas">
            <div class="panel-header">
                <h2>Tareas</h2>
            </div>

            <?php if (empty($listas)): ?>

                <p class="texto-muted">Selecciona o crea una lista para ver sus tareas.</p>

            <?php else: ?>

                <?php foreach ($listas as $index => $lista): ?>
                    <div
                        class="tareas-contenedor <?php echo $index === 0 ? 'visible' : ''; ?>"
                        id="lista-<?php echo $lista["id"]; ?>"
                    >
                        <h3><?php echo htmlspecialchars($lista["nombre"]); ?></h3>

                        <?php $tareas = Tarea::obtenerPorLista($lista["id"]); ?>

                        <?php if (empty($tareas)): ?>

                            <p class="texto-muted">No hay tareas en esta lista.</p>

                        <?php else: ?>

                            <ul class="tareas-lista">
                                <?php foreach ($tareas as $tarea): ?>
                                    <li>
                                        <div class="tarea-info">

                                            <button
                                                type="button"
                                                class="check-link toggle-tarea <?php echo $tarea["completada"] ? 'completada' : ''; ?>"
                                                data-id="<?php echo $tarea["id"]; ?>"
                                            >
                                                <?php echo $tarea["completada"] ? "✓" : ""; ?>
                                            </button>

                                            <span class="<?php echo $tarea["completada"] ? 'tarea-completada' : ''; ?>">
                                                <span class="tarea-nombre">
                                                    <?php echo htmlspecialchars($tarea["nombre"]); ?>
                                                </span>

                                                <?php if (!empty($tarea["descripcion"])): ?>
                                                    <span class="tarea-descripcion">
                                                        <?php echo htmlspecialchars($tarea["descripcion"]); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </span>

                                        </div>

                                        <button
                                            type="button"
                                            class="btn-mini btn-eliminar eliminar-tarea"
                                            data-id="<?php echo $tarea["id"]; ?>"
                                        >
                                            Eliminar
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

            <div class="panel-acciones">
                <?php if (!empty($listas)): ?>
                    <button type="button" class="btn-principal abrir-modal" data-modal="modal-tarea">
                        Añadir
                    </button>
                <?php endif; ?>
            </div>
        </article>

    </section>

</main>

<div class="modal-tareas" id="modal-lista">
    <div class="modal-contenido">
        <h2>Nueva lista</h2>

        <form id="form-crear-lista" action="index.php?ruta=crear_lista" method="POST">
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre de la lista" required>

            <label>Descripción</label>
            <textarea name="descripcion" placeholder="Descripción opcional"></textarea>

            <div class="modal-acciones">
                <button type="button" class="btn-secundario cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-principal">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-tareas" id="modal-tarea">
    <div class="modal-contenido">
        <h2>Nueva tarea</h2>

        <form id="form-crear-tarea" action="index.php?ruta=crear_tarea" method="POST">
            <input
                type="hidden"
                name="lista_id"
                id="lista-id-modal"
                value="<?php echo !empty($listas) ? $listas[0]["id"] : ""; ?>"
            >

            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre de la tarea" required>

            <label>Descripción</label>
            <textarea name="descripcion" placeholder="Descripción opcional"></textarea>

            <div class="modal-acciones">
                <button type="button" class="btn-secundario cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-principal">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputListaModal = document.getElementById("lista-id-modal");
    const btnEliminarLista = document.getElementById("btn-eliminar-lista");

    let listaSeleccionada = document.querySelector(".lista-item")
        ? document.querySelector(".lista-item").dataset.listaId
        : null;

    let eliminando = false;

    function actualizarListaSeleccionada(id) {
        listaSeleccionada = id;

        document.querySelectorAll(".lista-item").forEach(lista => {
            lista.classList.toggle("activa", lista.dataset.listaId === id);
        });

        document.querySelectorAll(".tareas-contenedor").forEach(contenedor => {
            contenedor.classList.toggle("visible", contenedor.id === "lista-" + id);
        });

        if (inputListaModal) {
            inputListaModal.value = id;
        }
    }

    document.addEventListener("click", async function (e) {

        const lista = e.target.closest(".lista-item");
        if (lista) {
            actualizarListaSeleccionada(lista.dataset.listaId);
        }

        const abrirModal = e.target.closest(".abrir-modal");
        if (abrirModal) {
            document.getElementById(abrirModal.dataset.modal).classList.add("visible");
        }

        const cerrarModal = e.target.closest(".cerrar-modal");
        if (cerrarModal) {
            cerrarModal.closest(".modal-tareas").classList.remove("visible");
        }

        const toggle = e.target.closest(".toggle-tarea");
        if (toggle) {
            const id = toggle.dataset.id;

            const respuesta = await fetch("index.php?ruta=toggle_tarea", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(id)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                const texto = toggle.nextElementSibling;

                toggle.classList.toggle("completada");
                texto.classList.toggle("tarea-completada");

                toggle.textContent = toggle.classList.contains("completada") ? "✓" : "";
            }
        }

        const botonEliminarTarea = e.target.closest(".eliminar-tarea");
        if (botonEliminarTarea) {
            e.preventDefault();

            if (eliminando) return;

            if (!confirm("¿Eliminar esta tarea?")) {
                return;
            }

            eliminando = true;

            const id = botonEliminarTarea.dataset.id;

            const respuesta = await fetch("index.php?ruta=eliminar_tarea_ajax", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(id)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                botonEliminarTarea.closest("li").remove();
            }

            eliminando = false;
        }

        if (e.target.closest("#btn-eliminar-lista")) {
            e.preventDefault();

            if (eliminando) return;
            if (!listaSeleccionada) return;

            if (!confirm("¿Eliminar esta lista y todas sus tareas?")) {
                return;
            }

            eliminando = true;

            const respuesta = await fetch("index.php?ruta=eliminar_lista_ajax", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + encodeURIComponent(listaSeleccionada)
            });

            const datos = await respuesta.json();

            if (datos.success) {
                document.querySelector('.lista-item[data-lista-id="' + listaSeleccionada + '"]')?.remove();
                document.getElementById("lista-" + listaSeleccionada)?.remove();

                const primeraLista = document.querySelector(".lista-item");

                if (primeraLista) {
                    actualizarListaSeleccionada(primeraLista.dataset.listaId);
                } else {
                    listaSeleccionada = null;
                }
            }

            eliminando = false;
        }
    });

    const formCrearLista = document.getElementById("form-crear-lista");

    if (formCrearLista) {
        formCrearLista.addEventListener("submit", async function (e) {
            e.preventDefault();

            const datos = new FormData(this);

            const respuesta = await fetch("index.php?ruta=crear_lista_ajax", {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.success) {
                const listaScroll = document.querySelector(".lista-scroll");

                const mensajeVacio = listaScroll.querySelector(".texto-muted");
                if (mensajeVacio) {
                    mensajeVacio.remove();
                }

                const botonLista = document.createElement("button");
                botonLista.type = "button";
                botonLista.className = "lista-item";
                botonLista.dataset.listaId = resultado.id;

                botonLista.innerHTML = `
                    <span class="lista-nombre">${resultado.nombre}</span>
                    ${
                        resultado.descripcion
                            ? `<span class="lista-descripcion">${resultado.descripcion}</span>`
                            : ""
                    }
                `;

                listaScroll.appendChild(botonLista);

                const contenedorTareas = document.createElement("div");
                contenedorTareas.className = "tareas-contenedor";
                contenedorTareas.id = "lista-" + resultado.id;
                contenedorTareas.innerHTML = `
                    <h3>${resultado.nombre}</h3>
                    <p class="texto-muted">No hay tareas en esta lista.</p>
                `;

                document
                    .querySelector(".panel-tareas:nth-child(2) .panel-acciones")
                    .before(contenedorTareas);

                actualizarListaSeleccionada(resultado.id);

                document.getElementById("modal-lista").classList.remove("visible");
                this.reset();
            }
        });
    }

    const formCrearTarea = document.getElementById("form-crear-tarea");

    if (formCrearTarea) {
        formCrearTarea.addEventListener("submit", async function (e) {
            e.preventDefault();

            const datos = new FormData(this);

            const respuesta = await fetch("index.php?ruta=crear_tarea_ajax", {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.success) {
                const contenedor = document.getElementById("lista-" + resultado.lista_id);

                let ul = contenedor.querySelector(".tareas-lista");

                const mensajeVacio = contenedor.querySelector(".texto-muted");
                if (mensajeVacio) {
                    mensajeVacio.remove();
                }

                if (!ul) {
                    ul = document.createElement("ul");
                    ul.className = "tareas-lista";
                    contenedor.appendChild(ul);
                }

                ul.insertAdjacentHTML("afterbegin", `
                    <li>
                        <div class="tarea-info">
                            <button
                                type="button"
                                class="check-link toggle-tarea"
                                data-id="${resultado.id}"
                            ></button>

                            <span>
                                <span class="tarea-nombre">${resultado.nombre}</span>
                                ${
                                    resultado.descripcion
                                        ? `<span class="tarea-descripcion">${resultado.descripcion}</span>`
                                        : ""
                                }
                            </span>
                        </div>

                        <button
                            type="button"
                            class="btn-mini btn-eliminar eliminar-tarea"
                            data-id="${resultado.id}"
                        >
                            Eliminar
                        </button>
                    </li>
                `);

                document.getElementById("modal-tarea").classList.remove("visible");
                this.reset();
            }
        });
    }

    if (listaSeleccionada) {
        actualizarListaSeleccionada(listaSeleccionada);
    }
});
</script>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>