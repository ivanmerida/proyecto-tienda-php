    <h2 class="titulo">CAMBIAR CONTRASEÑA</h2>
        <form action="<?= base_url . "Usuario/cambiar&id=" . $usuario_id ?>"  class="formulario " id="formulario" method="POST">
        <!-- Grupo: Contraseña -->
        <div class="formulario__grupo" id="grupo__password">
            <label for="password" class="formulario__label">Contraseña</label>
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" class="password" name="password" id="password" value="<?= isset($usuario) && is_object($usuario) && $editar ? $usuario->password : '' ?>">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Usa entre 6 y 20 caracteres</p>
            <img src="<?= base_url ?>imagenes/iconos/ocultar.svg" id="show-password">
        </div>

        <!-- Grupo: Contraseña2 -->
        <div class="formulario__grupo" id="grupo__password2">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" class="password2" name="password2" id="password2">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Ambas contraseñas tienen que ser iguales.</p>
            <img src="<?= base_url ?>imagenes/iconos/ocultar.svg" id="show-password2">
        </div>

        <div class="formulario__grupo formulario__grupo-mensaje" id="formulario__mensaje">
            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                <b>¡Error! </b>
                Por favor rellena el formulario correctamente.
            </p>
        </div>
        <?php if (isset($_SESSION['errores'])) : ?>
            <script>
                swal('Contraseña actualizada correctamente');
            </script>
            <?php Utils::deleteSession('errores'); ?>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
            <script>
                swal('No se pudo actualizar la contraseña.');
            </script>
            <?php Utils::deleteSession('register'); ?>
        <?php endif; ?>
        <div class="formulario__grupo formulario__grupo-btn-enviar">
            <button type="submit" class="formulario__btn">GUARDAR</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                Formulario enviado exitosamente!
            </p>
        </div>
    </form>