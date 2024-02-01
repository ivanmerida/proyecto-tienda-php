    <h2 class="titulo">GESTIONAR PRODUCTOS</h2>
    <a href="<?= base_url ?>Producto/crear" class="accion-boton">CREAR PRODUCTO</a>

    <form action="<?= base_url ?>Producto/gestion" id="formulario" method="POST" enctype="multipart/form-data">
        <!-- Grupo: Categoria -->
        <div class="formulario__grupo" id="grupo__categoria">
            <label for="categoria" class="formulario__label">Seleccione la Categoria a gestionar</label>
            <div class="formulario__grupo-input">
                <?php $categorias = Utils::showCategorias(); ?>
                <select class="formulario__input" name="categoria" id="categoria">
                    <?php while ($cat = $categorias->fetch_object()) : ?>
                        <option value="<?= $cat->id ?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '' ?>>
                            <?= $cat->nombre ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <p class="formulario__input-error">Selecciona una categoria disponible</p>
        </div>
        <br />
        <div class="formulario__grupo formulario__grupo-mensaje" id="formulario__mensaje">
            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b>Error: </b>Por favor rellena el
                formulario correctamente.</p>
        </div>
        <div class="formulario__grupo formulario__grupo-btn-enviar">
            <button type="submit" class="formulario__btn">SELECCIONAR</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                Formulario enviado exitosamente!
            </p>
        </div>
    </form>
    <br/>

    <?php if (isset($productos) && is_object($productos)) : ?>
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
                    <th>TALLA</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th>OFERTA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch_object()) : ?>
                    <tr>
                        <td><?= $producto->id ?></td>
                        <td><?= $producto->nombre ?></td>
                        <td><?= $producto->marca ?></td>
                        <td><?= $producto->talla ?></td>
                        <td><?= $producto->precio ?></td>
                        <td><?= $producto->stock ?></td>
                        <td><?= $producto->oferta ?></td>
                        <td>
                            <a class="tabla__btn" href="<?= base_url ?>Producto/editar&id=<?= $producto->id ?>">EDITAR</a>
                            <a class="tabla__btn rojo" href="<?= base_url ?>Producto/eliminar&id=<?= $producto->id ?>">ELIMINAR</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif ?>