<?php require_once __DIR__ . '/../plantillas/encabezado.php'; ?>
<?php require_once __DIR__ . '/../plantillas/navegacion.php'; ?>

<main class="pagina-perfil">

    <section class="perfil-panel">

        <div class="perfil-foto">
            <div class="avatar-placeholder">
                <?php echo strtoupper(substr($usuario["nombre"], 0, 1)); ?>
            </div>

            <button class="btn-secundario">Cambiar foto</button>

            <p class="perfil-fecha">
                Miembro desde<br>
                <strong><?php echo date("d/m/Y", strtotime($usuario["fecha_creacion"])); ?></strong>
            </p>
        </div>

        <div class="perfil-info">

            <h1>Perfil</h1>

            <?php if (isset($_SESSION["error"])): ?>
                <p class="mensaje-error"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
            <?php endif; ?>

            <?php if (isset($_SESSION["exito"])): ?>
                <p class="mensaje-exito"><?php echo $_SESSION["exito"]; unset($_SESSION["exito"]); ?></p>
            <?php endif; ?>

            <div class="perfil-bloque">
                <h2>Datos de usuario</h2>

                <div class="perfil-campo">
                    <div>
                        <span>Nombre</span>
                        <strong><?php echo htmlspecialchars($usuario["nombre"]); ?></strong>
                    </div>

                    <button class="btn-editar" data-modal="modal-nombre">Editar</button>
                </div>

                <div class="perfil-campo">
                    <div>
                        <span>Correo</span>
                        <strong><?php echo htmlspecialchars($usuario["correo"]); ?></strong>
                    </div>

                    <button class="btn-editar" data-modal="modal-correo">Editar</button>
                </div>

                <div class="perfil-campo">
                    <div>
                        <span>Género</span>
                        <strong><?php echo ucfirst($usuario["genero"] ?? "otro"); ?></strong>
                    </div>

                    <button class="btn-editar" data-modal="modal-genero">Editar</button>
                </div>
            </div>

            <div class="perfil-bloque">
                <h2>Preferencias</h2>

                <div class="perfil-campo">
                    <div>
                        <span>Pomodoro por defecto</span>
                        <strong>
                            <?php echo $preferencias["minutos_estudio"]; ?> min estudio :
                            <?php echo $preferencias["minutos_descanso"]; ?> min descanso
                        </strong>
                    </div>

                    <button class="btn-editar" data-modal="modal-pomodoro">Editar</button>
                </div>

                <div class="perfil-campo">
                    <div>
                        <span>Sonido favorito</span>
                        <strong><?php echo ucfirst($preferencias["sonido_favorito"]); ?></strong>
                    </div>

                    <button class="btn-editar" data-modal="modal-sonido">Editar</button>
                </div>
            </div>

            <button class="btn-eliminar" data-modal="modal-eliminar">
                Eliminar perfil
            </button>

        </div>

    </section>

</main>

<div class="modal" id="modal-nombre">
    <div class="modal-contenido">
        <h2>Actualizar nombre</h2>

        <form action="index.php?ruta=actualizar_perfil" method="POST">
            <input type="hidden" name="correo" value="<?php echo htmlspecialchars($usuario["correo"]); ?>">
            <input type="hidden" name="genero" value="<?php echo htmlspecialchars($usuario["genero"] ?? "otro"); ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario["nombre"]); ?>" required>

            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal-correo">
    <div class="modal-contenido">
        <h2>Actualizar correo</h2>

        <form action="index.php?ruta=actualizar_perfil" method="POST">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($usuario["nombre"]); ?>">
            <input type="hidden" name="genero" value="<?php echo htmlspecialchars($usuario["genero"] ?? "otro"); ?>">

            <label>Correo</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario["correo"]); ?>" required>

            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal-genero">
    <div class="modal-contenido">
        <h2>Actualizar género</h2>

        <form action="index.php?ruta=actualizar_perfil" method="POST">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($usuario["nombre"]); ?>">
            <input type="hidden" name="correo" value="<?php echo htmlspecialchars($usuario["correo"]); ?>">

            <label>Género</label>
            <select name="genero" required>
                <option value="masculino" <?php echo ($usuario["genero"] ?? "") === "masculino" ? "selected" : ""; ?>>Masculino</option>
                <option value="femenino" <?php echo ($usuario["genero"] ?? "") === "femenino" ? "selected" : ""; ?>>Femenino</option>
                <option value="otro" <?php echo ($usuario["genero"] ?? "") === "otro" ? "selected" : ""; ?>>Otro</option>
            </select>

            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal-pomodoro">
    <div class="modal-contenido">
        <h2>Actualizar pomodoro</h2>
        <form action="index.php?ruta=actualizar_pomodoro" method="POST">
            <label>Minutos de estudio</label>
            <input
                type="number"
                name="minutos_estudio"
                value="<?php echo $preferencias['minutos_estudio']; ?>"
                required>

            <label>Minutos de descanso</label>
            <input
                type="number"
                name="minutos_descanso"
                value="<?php echo $preferencias['minutos_descanso']; ?>"
                required>
            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal-sonido">
    <div class="modal-contenido">
        <h2>Actualizar sonido</h2>

        <form action="index.php?ruta=actualizar_sonido" method="POST">
            <label>Sonido favorito</label>
            <select name="sonido_favorito">

                <option value="spotify"
                    <?php echo $preferencias["sonido_favorito"] === "spotify" ? "selected" : ""; ?>>
                    Spotify
                </option>

                <option value="lluvia"
                    <?php echo $preferencias["sonido_favorito"] === "lluvia" ? "selected" : ""; ?>>
                    Lluvia
                </option>

                <option value="biblioteca"
                    <?php echo $preferencias["sonido_favorito"] === "biblioteca" ? "selected" : ""; ?>>
                    Biblioteca
                </option>

                <option value="cafeteria"
                    <?php echo $preferencias["sonido_favorito"] === "cafeteria" ? "selected" : ""; ?>>
                    Cafetería
                </option>

            </select>

            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modal-eliminar">
    <div class="modal-contenido">
        <h2>Eliminar perfil</h2>
        <p>Esta acción no se puede deshacer.</p>
        
        <form action="index.php?ruta=eliminar_perfil" method="POST">
            <div class="modal-acciones">
                <button type="button" class="btn-cancelar cerrar-modal">Cancelar</button>
                <button type="submit" class="btn-eliminar">Eliminar</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../plantillas/pie.php'; ?>