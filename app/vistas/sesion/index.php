<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-sesion">

    <section class="sesion-hero">
        <h1>Sesión de Estudio</h1>
        <p>Organiza tu tiempo, sigue tus tareas y mantén el foco.</p>
    </section>

    <?php if ($sesion_activa): ?>

        <section class="sesion-activa-layout">

            <aside class="sesion-lateral">

                <div class="bloque-tiempo">
                    <span id="fase-pomodoro" class="fase-pomodoro">Tiempo de estudio</span>

                    <div
                        id="temporizador"
                        class="temporizador compacto"
                        data-sesion-id="<?php echo $sesion_activa["id"]; ?>"
                        data-inicio="<?php echo $sesion_activa["fecha_inicio"]; ?>"
                        data-minutos-estudio="<?php echo $sesion_activa["minutos_estudio"]; ?>"
                        data-minutos-descanso="<?php echo $sesion_activa["minutos_descanso"]; ?>"
                        data-bloques="<?php echo $sesion_activa["bloques"]; ?>"
                    >
                        00:00
                    </div>

                    <p id="bloque-pomodoro" class="bloque-pomodoro">
                        Bloque 1 de <?php echo $sesion_activa["bloques"]; ?>
                    </p>

                    <progress id="barra-progreso" value="0" max="100"></progress>
                    <p id="porcentaje-progreso">0%</p>
                </div>

                <div class="bloque-tareas-sesion">
                    <h3>Tareas de la sesión</h3>

                    <?php if (empty($tareas_sesion)): ?>

                        <p class="texto-muted">No hay tareas asociadas a esta sesión.</p>

                    <?php else: ?>

                        <ul>
                            <?php foreach ($tareas_sesion as $tarea): ?>
                                <li>
                                    <?php if ($tarea["completada"]): ?>

                                        <span class="check completada">✓</span>
                                        <span class="tarea-completada">
                                            <?php echo htmlspecialchars($tarea["nombre"]); ?>
                                        </span>

                                    <?php else: ?>

                                        <a class="check-link" href="index.php?ruta=completar_tarea_sesion&id=<?php echo $tarea["id"]; ?>">
                                            □
                                        </a>
                                        <span><?php echo htmlspecialchars($tarea["nombre"]); ?></span>

                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </div>

            </aside>

            <section class="sesion-principal">

                <div class="sesion-card-musica">
                    <span class="sesion-estado activa">Sesión activa</span>

                    <h2><?php echo htmlspecialchars($sesion_activa["nombre_sesion"]); ?></h2>

                    <p class="texto-muted">
                        Sonido actual: <?php echo htmlspecialchars($sesion_activa["sonido"]); ?>
                    </p>

                    <div class="musica-placeholder">

    <?php if ($sesion_activa["sonido"] === "spotify"): ?>

    <iframe
        class="spotify-widget"
        src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6"
            width="100%"
            height="352"
            frameborder="0"
            allowfullscreen=""
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture">
    ></iframe>

<?php else: ?>

    <video
        class="video-ambiente"
        autoplay
        muted
        loop
        playsinline
    >
        <source src="assets/video/fondo_estudio.mp4" type="video/mp4">
    </video>

<?php endif; ?>

</div>

                    <div class="sesion-info-grid">
                        <p>
                            <strong>Lista</strong>
                            <span>
                                <?php echo $sesion_activa["nombre_lista"] ? htmlspecialchars($sesion_activa["nombre_lista"]) : "Sin lista asociada"; ?>
                            </span>
                        </p>

                        <p>
                            <strong>Estudio</strong>
                            <span><?php echo $sesion_activa["minutos_estudio"]; ?> min</span>
                        </p>

                        <p>
                            <strong>Descanso</strong>
                            <span><?php echo $sesion_activa["minutos_descanso"]; ?> min</span>
                        </p>

                        <p>
                            <strong>Bloques</strong>
                            <span><?php echo $sesion_activa["bloques"]; ?></span>
                        </p>
                    </div>
                </div>

                <div class="sesion-acciones acciones-pomodoro">
                    <button type="button" class="btn-secundario" id="btn-pausar">Pausar</button>

                    <button type="button" class="btn-secundario" id="btn-reanudar">Reanudar</button>

                    <a class="btn-principal" href="index.php?ruta=finalizar_sesion&id=<?php echo $sesion_activa["id"]; ?>">
                        Finalizar
                    </a>
                </div>

            </section>

        </section>

    <?php else: ?>

        <section class="sesion-card sesion-vacia">

            <h2>No tienes ninguna sesión activa</h2>

            <p>Crea una nueva sesión para comenzar a estudiar con temporizador y tareas asociadas.</p>

            <a class="btn-principal" href="index.php?ruta=nueva_sesion">
                Nueva sesión
            </a>
        </section>

        <?php if ($ultima_sesion): ?>

    <?php
        $segundos = (int) $ultima_sesion["segundos_totales"];

        $horas = floor($segundos / 3600);
        $minutos = floor(($segundos % 3600) / 60);
        $segundos_restantes = $segundos % 60;

        $duracion_formateada = "";

        if ($horas > 0) {
            $duracion_formateada .= $horas . " hora" . ($horas > 1 ? "s" : "") . " ";
        }

        if ($minutos > 0) {
            $duracion_formateada .= $minutos . " minuto" . ($minutos > 1 ? "s" : "") . " ";
        }

        if ($segundos_restantes > 0 || $duracion_formateada === "") {
            $duracion_formateada .= $segundos_restantes . " segundos";
        }
    ?>

    <section class="sesion-card sesion-vacia">
    <h2>Datos de última sesión</h2>

    <div class="ultima-sesion-cards">

        <article class="dato-sesion-card card-duracion">
            <span>Duración</span>
            <strong><?php echo trim($duracion_formateada); ?></strong>
        </article>

        <article class="dato-sesion-card card-estado">
            <span>Estado</span>
            <strong><?php echo htmlspecialchars($ultima_sesion["estado"]); ?></strong>
        </article>

        <article class="dato-sesion-card card-nombre">
            <span>Nombre</span>
            <strong><?php echo htmlspecialchars($ultima_sesion["nombre_sesion"]); ?></strong>
        </article>

        <article class="dato-sesion-card card-fecha">
            <span>Finalizada</span>
            <strong>
                <?php echo date("d/m/Y H:i", strtotime($ultima_sesion["fecha_fin"])); ?>
            </strong>
        </article>

    </div>
</section>

    <?php endif; ?>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>