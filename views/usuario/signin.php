<h2 class="titulo">Registrate</h2>
<!--<a href="<?= base_url ?>usuario/save" class="accion-boton">CREAR CATEGORÍA</a>-->
<?php $url_action = base_url . "usuario/registrar"; ?>

<form action="<?= $url_action ?>" class="formulario " id="formulario" method="POST">
    <!-- Grupo: Nombre -->
    <div class="formulario__grupo" id="grupo__nombre">
        <label for="usuario" class="formulario__label">Nombre</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Juan Carlos" value="<?= isset($usuario) && is_object($usuario) && $editar ? $usuario->nombre : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
    </div>
    <!-- Grupo: Apellido -->
    <div class="formulario__grupo" id="grupo__apellido">
        <label for="nombre" class="formulario__label">Apellido</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" id="apellido" name="apellido" placeholder="Rio Gonzalez" value="<?= isset($usuario) && is_object($usuario) && $editar ? $usuario->apellido : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
    </div>

    <!-- Grupo: Contraseña -->
    <div class="formulario__grupo" id="grupo__password">
        <label for="password" class="formulario__label">Contraseña</label>
        <div class="formulario__grupo-input">
            <input type="password" class="formulario__input" class="password" name="password" id="password">
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

    <!-- Grupo: Correo Electrónico -->
    <div class="formulario__grupo" id="grupo__correo">
        <label for="correo" class="formulario__label">Correo Electrónico</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" class="correo" id="correo" name="correo" placeholder="correo@correo.com" value="<?= isset($usuario) && is_object($usuario) && $editar ? $usuario->correo : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Correo Electrónico no valido</p>
    </div>
    <!-- Grupo: Teléfono -->
    <div class="formulario__grupo" id="grupo__telefono">
        <label for="telefono" class="formulario__label">Teléfono</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" class="telefono" id="telefono" name="telefono" placeholder="4751234567" value="<?= isset($usuario) && is_object($usuario) && $editar ? $usuario->telefono : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Numero de telefono no valido</p>
    </div>
    <!--<?php if (!isset($usuario) && !is_object($usuario) && !$editar) : ?>-->
    <!-- Grupo: Terminos y Condiciones -->
    <div class="formulario__grupo formulario__grupo-terminos" id="grupo__terminos">
        <label class="formulario__label">
            <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
            Declaro que soy mayor de edad, acepto los Términos y Condiciones y autorizo el uso de mis datos
            de acuerdo a la Declaración de Privacidad.
        </label>
    </div>
    <!--<?php endif; ?>-->
    <div class="formulario__grupo formulario__grupo-mensaje" id="formulario__mensaje">
        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <b>¡Error! </b>
            Por favor rellena el formulario correctamente.
        </p>
    </div>
    <?php if (isset($_SESSION['errores'])) : ?>
        <script>
            swal('El usuario no pudo ser creado.');
        </script>
        <?php Utils::deleteSession('errores'); ?>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
        <script>
            swal('El usuario no pudo ser creado.');
        </script>
        <?php Utils::deleteSession('register'); ?>
    <?php endif; ?>
    <div class="formulario__grupo formulario__grupo-btn-enviar">
        <button type="submit" class="formulario__btn"><?= isset($usuario) && is_object($usuario) && $editar ? 'GUARDAR' : 'REGISTRAR' ?></button>
        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
            Formulario enviado exitosamente!
        </p>
    </div>
</form>