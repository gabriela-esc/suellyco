<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-sesion">

    <section class="sesion-hero">
        <span class="sesion-etiqueta">Nueva sesión</span>
        <h1>Configura tu sesión</h1>
        <p>Elige una lista, define tus tiempos y empieza a concentrarte.</p>
    </section>

    <section class="sesion-card nueva-sesion-card">

        <form class="form-sesion" action="index.php?ruta=crear_sesion" method="POST">

            <div class="campo-form">
                <label>Nombre de la sesión</label>
                <input type="text" name="nombre_sesion" placeholder="Ej: Repaso de matemáticas" required>
            </div>

            <div class="campo-form">
                <label>Lista de tareas</label>
                <select name="lista_id">
                    <option value="">Sin lista asociada</option>

                    <?php foreach ($listas as $lista): ?>
                        <option value="<?php echo $lista["id"]; ?>">
                            <?php echo htmlspecialchars($lista["nombre"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-grid">
                <div class="campo-form">
                    <label>Minutos de estudio</label>
                    <input type="number" name="minutos_estudio" value="25" min="1" required>
                </div>

                <div class="campo-form">
                    <label>Minutos de descanso</label>
                    <input type="number" name="minutos_descanso" value="5" min="0" required>
                </div>

                <div class="campo-form">
                    <label>Bloques Pomodoro</label>
                    <input type="number" name="bloques" value="1" min="1" required>
                </div>
            </div>

            <div class="campo-form">
                <label>Sonido</label>
                <select name="sonido">
                    <option value="biblioteca">Biblioteca</option>
                    <option value="lluvia">Lluvia</option>
                    <option value="oficina">Oficina</option>
                    <option value="cafeteria">Cafetería</option>
                    <option value="spotify">Spotify</option>
                    <option value="silencio">Silencio</option>
                </select>
            </div>

            <div class="sesion-acciones">
                <button type="submit" class="btn-principal">
                    Iniciar sesión
                </button>

                <a href="index.php?ruta=sesion" class="btn-secundario">
                    Volver
                </a>
            </div>

        </form>

    </section>

</main>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>