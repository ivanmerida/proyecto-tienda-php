<h2 class="titulo">PRODUCTOS EN OFERTA</h2>
<?php if ($productos->num_rows == 0) : ?>
    <p class="no-hay-producto">No hay productos para mostrar</p>
<?php else : ?>
    <div class="productos">
        <?php while ($producto = $productos->fetch_object()) : ?>
            <div class="producto producto--sombra">
                <div class="producto__info">

                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>">
                        <?php if ($producto->imagen != null) : ?>
                            <img class="producto__imagen" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen del producto">
                        <?php else : ?>
                            <img class="producto__imagen" src="<?= imagen_defecto ?>" alt="Imagen del producto">
                        <?php endif; ?>
                        <span class="producto__nombre"><?= $producto->nombre ?></span>
                    </a>
                    <span class="producto__precio">$<?= $producto->precio ?></span>
                </div>
                <div class="producto__btns">
                    <div class="producto__btn">
                        <a href="<?= base_url ?>Carrito/add&id=<?= $producto->id ?>" class="producto__btn-a">Comprar</a>
                    </div>
                    <div class="producto__btn">
                        <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>" class="producto__btn-a">Descripcion</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>