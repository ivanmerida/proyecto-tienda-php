<?php if (isset($edit) && isset($pro) && is_object($pro)) : ?>
    <h2 class="titulo">Editar Producto <?= $pro->nombre ?></h2>
    <?php $url_action = base_url . "producto/save&id=" . $pro->id; ?>
<?php else : ?>
    <h2 class="titulo">Crear Producto</h2>
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<!--enctype="multipart/form-data" para enviar ficheros por el formulario (imagenes) sino no va a guardar
la imagen en la BD-->

<form action="<?= $url_action ?>" class="formulario formulario__crear-producto" id="formulario" method="POST" enctype="multipart/form-data">
    <!-- Grupo: nombre -->
    <div class="formulario__grupo" id="grupo__nombre">
        <label for="usuario" class="formulario__label">Nombre</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Playera Nike"  value="<?= isset($pro) && is_object($pro) ? $pro->nombre : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa el nombre del producto</p>
    </div>
    <!-- Grupo: Stock -->
    <div class="formulario__grupo" id="grupo__stock">
        <label for="stock" class="formulario__label">Stock</label>
        <div class="formulario__grupo-input">
            <input type="number" class="formulario__input" id="stock" name="stock" placeholder="00000" value="<?= isset($pro) && is_object($pro) ? $pro->stock : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa la cantidad de unidades</p>
    </div>
    <!-- Grupo: Talla -->
    <div class="formulario__grupo" id="grupo__talla">
        <label for="tallas" class="formulario__label">Talla</label>
        <div class="formulario__grupo-input">
            <select class="formulario__input" name="tallas" id="tallas">
                <option value="CHICA" <?= isset($pro) && $pro->talla == 'CHICA' ? 'selected' : '' ?>>CHICA</option>
                <option value="MEDIANA" <?= isset($pro) && $pro->talla == 'MEDIANA' ? 'selected' : '' ?>>MEDIANA</option>
                <option value="GRANDE" <?= isset($pro) && $pro->talla == 'GRANDE' ? 'selected' : '' ?>>GRANDE</option>
            </select>
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa tallas disponibles</p>
    </div>
    <!-- Grupo: Descripcion -->
    <div class="formulario__grupo" id="grupo__descripcion">
        <label for="tallas" class="formulario__label">Descripcion</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" name="descripcion" id="descripcion" value="<?= isset($pro) && is_object($pro) ? $pro->descripcion : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa una breve descripcion del producto</p>
    </div>
    <!-- Grupo: Categoria -->
    <div class="formulario__grupo" id="grupo__categoria">
        <label for="tallas" class="formulario__label">Categoria</label>
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
    <!-- Grupo: Marca -->
    <div class="formulario__grupo" id="grupo__marca">
        <label for="tallas" class="formulario__label">Marca</label>
        <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" name="marca" id="marca" value="<?= isset($pro) && is_object($pro) ? $pro->marca : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa la marca del producto</p>
    </div>
    <!-- Grupo: Precio -->
    <div class="formulario__grupo" id="grupo__precio">
        <label for="tallas" class="formulario__label">Precio</label>
        <div class="formulario__grupo-input">
            <input type="number" class="formulario__input" name="precio" id="precio" value="<?= isset($pro) && is_object($pro) ? $pro->precio : '' ?>">
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa el precio del producto</p>
    </div>
    <!-- Grupo: Oferta -->
    <div class="formulario__grupo" id="grupo__oferta">
        <label for="oferta" class="formulario__label">Oferta</label>
        <div class="formulario__grupo-input">
            <select class="formulario__input" name="oferta" id="oferta">
                <option value="SI" <?= isset($pro) && $pro->oferta == 'SI' ? 'selected' : '' ?>>SI</option>
                <option value="NO" <?= isset($pro) && $pro->oferta == 'NO' ? 'selected' : '' ?>>NO</option>
                
            </select>
            <i class="formulario__validacion-estado fa fa-times-circle" aria-hidden="true"></i>
        </div>
        <p class="formulario__input-error">Ingresa tallas disponibles</p>
    </div>
    <!-- Grupo: Imagen -->
    <div class="formulario__grupo" id="grupo__imagen">
        <label for="imagen" class="formulario__label">Imagen</label>
        <div class="formulario__grupo-input">
            <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
                <img src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>" class="thumb" />
                <input type="file" class="formulario__input" name="imagen" id="imagen">
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