<?php if (isset($product)) : ?>
    <h3 class="titulo titulo--left"><?= $product->nombre ?></h3>
    <div class="producto-indiv">
        <div class="producto-indiv__imagen">
            <?php if ($product->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
            <?php else : ?>
                <img src="<?= imagen_defecto ?>" />
            <?php endif; ?>
        </div>
        <div class="datos">
                <p class="description"><strong>Descripción:</strong> <?= $product->descripcion ?></p>
                <p><strong>Talla:</strong> <?= $product->talla?></p>
                <p><strong>Marca:</strong> <?= $product->marca ?></p>
                <p class="producto__precio producto__precio-izq">$<?= $product->precio ?></p>
                <a class="btn-comprar" href="<?= base_url ?>carrito/add&id=<?= $product->id ?>">Comprar</a>
        </div>
    </div>

<?php else : ?>
    <h3>El producto no existe</h3>
<?php endif; ?>