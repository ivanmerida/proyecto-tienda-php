            <h2 class="titulo">INICIAR SESIÓN</h2>
            <form action="<?= base_url ?>Usuario/loguear" class="formulario formulario__login" id="formulario" method="POST">
                <!-- Grupo: Correo Electrónico -->
                <div class="formulario__grupo" id="grupo__correo">
                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" class="correo" id="correo" name="correo" placeholder="correo@correo.com">
                        <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
                    </div>
                    <p class="formulario__input-error">Correo Electrónico no valido</p>
                </div>
                <!-- Grupo: Contraseña -->
                <div class="formulario__grupo" id="grupo__password">
                    <label for="password" class="formulario__label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" class="password" name="password" id="password">
                        <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
                    </div>
                    <p class="formulario__input-error">Usa entre 6 y 20 caracteres</p>
                </div>
                <img src="<?= base_url ?>imagenes/iconos/ocultar.svg" id="show-password">

                <div class="formulario__grupo formulario__grupo-mensaje" id="formulario__mensaje">
                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b>Error: </b>Por favor rellena el
                        formulario correctamente.</p>
                </div>
                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="formulario__btn">ACEPTAR</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                        Formulario enviado exitosamente!
                    </p>
                </div>
                
            </form>