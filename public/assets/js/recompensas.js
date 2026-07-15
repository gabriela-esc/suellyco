document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);

    if (params.get("recompensa") !== "1") {
        return;
    }

    const recompensas = [
        {
            icono: "🎉",
            titulo: "¡Buen trabajo!",
            mensaje: "Has completado una tarea."
        },
        {
            icono: "🚀",
            titulo: "Sigue así",
            mensaje: "Un paso más cerca de tu objetivo."
        },
        {
            icono: "⭐",
            titulo: "Excelente avance",
            mensaje: "Tu progreso sigue creciendo."
        },
        {
            icono: "🔥",
            titulo: "Gran ritmo",
            mensaje: "Estás manteniendo la concentración."
        },
        {
            icono: "🏆",
            titulo: "Objetivo cumplido",
            mensaje: "Una tarea menos en tu camino."
        }
    ];

    const recompensa = recompensas[Math.floor(Math.random() * recompensas.length)];

    const contenedor = document.createElement("div");
    contenedor.classList.add("recompensa-toast");

    contenedor.innerHTML = `
        <div class="recompensa-icono">${recompensa.icono}</div>
        <h2>${recompensa.titulo}</h2>
        <p>${recompensa.mensaje}</p>
    `;

    document.body.appendChild(contenedor);

    setTimeout(function () {
        contenedor.classList.add("mostrar");
    }, 100);

    setTimeout(function () {
        contenedor.classList.remove("mostrar");
    }, 2600);

    setTimeout(function () {
        contenedor.remove();

        const url = new URL(window.location.href);
        url.searchParams.delete("recompensa");
        window.history.replaceState({}, document.title, url.toString());
    }, 3200);
});