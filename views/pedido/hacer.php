<?php if (isset($_SESSION['identity'])) : ?>
    <h2 class="titulo">Realizar pedido</h2>
    <div class="boton-detalle">
        <a href="<?= base_url ?>Carrito/index">Detalle del pedido </a>
    </div>
    <h3 class="titulo titulo--left">Domicilio para el envió</h3>
    <form action="<?= base_url ?>Pedido/add" class="formulario " id="formulario" method="POST">
        <!-- Grupo: Municipio -->
        <div class="formulario__grupo" id="grupo__municipio">
            <label for="usuario" class="formulario__label">Municipio</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" id="municipio" name="municipio" placeholder="Comitán de Domínguez">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
        </div>
        <!-- Grupo: Localidad -->
        <div class="formulario__grupo" id="grupo__localidad">
            <label for="localidad" class="formulario__label">Localidad</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" id="localidad" name="localidad" placeholder="Miguel Aleman">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
        </div>
        <!-- Grupo: Dirección -->
        <div class="formulario__grupo" id="grupo__direccion">
            <label for="direccion" class="formulario__label">Dirección (barrio, calle, numero int y ext)</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" id="direccion" name="direccion" placeholder="Comitán de Domínguez">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
        </div>
        <!-- Grupo: Referencia -->
        <div class="formulario__grupo" id="grupo__referencia">
            <label for="referencia" class="formulario__label">Referencia</label>
            <div class="formulario__grupo-input">
                <textarea class="formulario__input" id="referencia" name="referencia">
                </textarea>
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true">
                </i>
            </div>
            <p class="formulario__input-error">Ingrésalo tal como figura en tu documento.</p>
        </div>
        <!-- Grupo: Teléfono -->
        <div class="formulario__grupo" id="grupo__telefono">
            <label for="telefono" class="formulario__label">Teléfono</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" class="telefono" id="telefono" name="telefono" placeholder="4751234567">
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Numero de telefono no valido</p>
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
            <button type="submit" class="formulario__btn">GUARDAR</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                Formulario enviado exitosamente!
            </p>
        </div>
    </form>
<?php else : ?>
    <h1>Necesitas iniciar sesión para proceder con tu compra.</h1>
<?php endif; ?>