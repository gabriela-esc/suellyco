document.addEventListener("DOMContentLoaded", function () {
    const temporizador = document.getElementById("temporizador");

    if (!temporizador) return;

    const barraProgreso = document.getElementById("barra-progreso");
    const porcentajeProgreso = document.getElementById("porcentaje-progreso");
    const fasePomodoro = document.getElementById("fase-pomodoro");
    const bloquePomodoro = document.getElementById("bloque-pomodoro");

    const btnPausar = document.getElementById("btn-pausar");
    const btnReanudar = document.getElementById("btn-reanudar");

    const sesionId = temporizador.dataset.sesionId;
    const fechaInicio = new Date(temporizador.dataset.inicio.replace(" ", "T"));
    const minutosEstudio = parseInt(temporizador.dataset.minutosEstudio);
    const minutosDescanso = parseInt(temporizador.dataset.minutosDescanso);
    const totalBloques = parseInt(temporizador.dataset.bloques);

    const segundosEstudio = minutosEstudio * 60;
    const segundosDescanso = minutosDescanso * 60;
    const segundosPorBloque = segundosEstudio + segundosDescanso;
    const segundosTotalesSesion = segundosPorBloque * totalBloques;

    let pausado = false;
    let tiempoPausadoAcumulado = 0;
    let inicioPausa = null;

    function obtenerEstadoActual() {
        const ahora = new Date();

        let segundosTranscurridos = Math.floor((ahora - fechaInicio) / 1000) - tiempoPausadoAcumulado;

        if (segundosTranscurridos >= segundosTotalesSesion) {
            window.location.href = `index.php?ruta=finalizar_sesion_automatica&id=${sesionId}`;
            return null;
        }

        const bloqueActual = Math.floor(segundosTranscurridos / segundosPorBloque) + 1;
        const segundosDentroBloque = segundosTranscurridos % segundosPorBloque;

        let faseActual;
        let duracionActual;
        let segundosRestantes;

        if (segundosDentroBloque < segundosEstudio) {
            faseActual = "estudio";
            duracionActual = segundosEstudio;
            segundosRestantes = segundosEstudio - segundosDentroBloque;
        } else {
            faseActual = "descanso";
            duracionActual = segundosDescanso;
            segundosRestantes = segundosPorBloque - segundosDentroBloque;
        }

        return {
            bloqueActual,
            faseActual,
            duracionActual,
            segundosRestantes
        };
    }

    function pintarTemporizador() {
        const estado = obtenerEstadoActual();

        if (!estado) return;

        const minutos = Math.floor(estado.segundosRestantes / 60);
        const segundos = estado.segundosRestantes % 60;

        temporizador.textContent =
            String(minutos).padStart(2, "0") +
            ":" +
            String(segundos).padStart(2, "0");

        const transcurridoFase = estado.duracionActual - estado.segundosRestantes;
        const porcentaje = Math.floor((transcurridoFase / estado.duracionActual) * 100);

        if (barraProgreso) barraProgreso.value = porcentaje;
        if (porcentajeProgreso) porcentajeProgreso.textContent = porcentaje + "%";

        if (fasePomodoro) {
            fasePomodoro.textContent =
                estado.faseActual === "estudio"
                    ? "Tiempo de estudio"
                    : "Tiempo de descanso";
        }

        if (bloquePomodoro) {
            bloquePomodoro.textContent =
                "Bloque " + estado.bloqueActual + " de " + totalBloques;
        }
    }

    if (btnPausar) {
        btnPausar.addEventListener("click", function () {
            if (!pausado) {
                pausado = true;
                inicioPausa = new Date();
            }
        });
    }

    if (btnReanudar) {
        btnReanudar.addEventListener("click", function () {
            if (pausado && inicioPausa) {
                const ahora = new Date();
                tiempoPausadoAcumulado += Math.floor((ahora - inicioPausa) / 1000);
                pausado = false;
                inicioPausa = null;
            }
        });
    }

    pintarTemporizador();

    setInterval(function () {
        if (!pausado) {
            pintarTemporizador();
        }
    }, 1000);
});