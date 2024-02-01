            <?php if (isset($categoria) && is_object($categoria) && $editar) : ?>
                <h2 class="titulo">EDITAR <?= $categoria->nombre ?></h2>
                <?php $url_action = base_url . "categoria/save&id=" . $categoria->id; ?>
            <?php else : ?>
                <h2 class="titulo">CREAR CATEGORIA</h2>
                <a href="<?= base_url ?>Categoria/save" class="accion-boton">CREAR CATEGORÍA</a>
                <?php $url_action = base_url . "categoria/save"; ?>
            <?php endif; ?>
            <form action="<?= $url_action ?>" class="formulario" id="formulario" method="POST" enctype="multipart/form-data">
                <!-- Grupo: Correo Nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">NOMBRE</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" class="nombre" id="nombre" name="nombre" placeholder="Pijamas" value="<?= isset($categoria) && is_object($categoria) && $editar ? $categoria->nombre : '' ?>">
                        <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
                    </div>
                    <p class="formulario__input-error">Ingresa el nombre de la categoría.</p>
                </div>
                <!-- Grupo: Imagen -->
                <div class="formulario__grupo" id="grupo__imagen">
                    <label for="imagen" class="formulario__label">Imagen</label>
                    <div class="formulario__grupo-input">
                        <?php if (isset($categoria) && is_object($categoria) && !empty($categoria->imagen)) : ?>
                            <input type="file" class="formulario__input" name="imagen" id="imagen">
                            <img src="<?= base_url ?>/uploads/categoria-images/<?= $categoria->imagen ?>" class="thumb" />
                            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
                        <?php else : ?>
                            <input type="file" class="formulario__input" name="imagen" id="imagen">
                            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
                        <?php endif; ?>
                    </div>
                    <p class="formulario__input-error">Seleccion la imagen del producto</p>
                </div>

                <div class="formulario__grupo formulario__grupo-mensaje" id="formulario__mensaje">
                    <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b>Error: </b>Por favor rellena el
                        formulario correctamente.</p>
                </div>
                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="formulario__btn">GUARDAR</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                        Formulario enviado exitosamente!
                    </p>
                </div>
            </form>