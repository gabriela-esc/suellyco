<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-metricas">

    <section class="metricas-hero">
        <h1>Métricas</h1>
        <p>Consulta tu tiempo de estudio, sesiones, tareas y progreso por lista.</p>
    </section>

    <section class="metricas-panel">

        <div class="metricas-layout-boceto">

            <div class="metricas-columna">

                <article class="metrica-card">
                    <span>Tiempo estudiado</span>
                    <p>Hoy: <?php echo $tiempo_hoy; ?> min</p>
                    <p>Esta semana: <?php echo $tiempo_semana; ?> min</p>
                    <p>Este mes: <?php echo $tiempo_mes; ?> min</p>
                    <p>Total: <?php echo $tiempo_total; ?> min</p>
                </article>

                <article class="metrica-card">
                    <span>Sesiones realizadas</span>
                    <p>Esta semana: <?php echo $sesiones_semana; ?></p>
                    <p>Este mes: <?php echo $sesiones_mes; ?></p>
                </article>

                <article class="metrica-card">
                    <span>Tareas completadas</span>
                    <strong><?php echo $tareas_completadas; ?> tareas</strong>
                </article>

            </div>

            <article class="metrica-card metrica-card-grande">
                <span>Progreso por lista</span>

                <?php if (empty($progreso_listas)): ?>

                    <p>No tienes listas todavía.</p>

                <?php else: ?>

                    <?php foreach ($progreso_listas as $lista): ?>
                        <?php
                            $porcentaje = $lista["total_tareas"] > 0
                                ? round(($lista["completadas"] / $lista["total_tareas"]) * 100)
                                : 0;
                        ?>

                        <p class="fila-metrica">
                            <?php echo htmlspecialchars($lista["nombre"]); ?>
                            <span><?php echo $porcentaje; ?>%</span>
                        </p>
                    <?php endforeach; ?>

                <?php endif; ?>

            </article>

            <article class="metrica-card metrica-card-grande">
                <span>Historial</span>

                <?php if (empty($historial)): ?>

                    <p>No hay historial todavía.</p>

                <?php else: ?>

                    <?php foreach ($historial as $dia): ?>
                        <p class="fila-metrica">
                            <?php echo date("d/m", strtotime($dia["fecha"])); ?>
                            <span><?php echo $dia["minutos"]; ?> min</span>
                        </p>
                    <?php endforeach; ?>

                <?php endif; ?>

            </article>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>