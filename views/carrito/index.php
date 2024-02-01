<h2 class="titulo">Carrito de la compra</h2>
<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <table class="tabla tabla-carrito">
        <thead>
            <tr>
                <th class="th-carrito">Producto</th>
                <th class="th-carrito">Nombre</th>
                <th class="th-carrito">Precio</th>
                <th class="th-carrito">Unidades</th>
                <th class="th-carrito">Eliminar</th>
            </tr>
        </thead>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tbody>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null) : ?>
                            <img class="img_carrito" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" />
                        <?php else : ?>
                            <img class="img_carrito" src="<?= imagen_defecto ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <a id="carrito-nombre" href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
                            <?= $producto->nombre ?>
                        </a>
                    </td>
                    <td><?= $producto->precio ?></td>
                    <td>
                        <?= $elemento['unidades'] ?>
                        <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>" class="boton-carrito carrito-up">+</a>
                        <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="boton-carrito carrito-down">-</a>
                    </td>
                    <td>
                        <a id="carrito-delete" href="<?= base_url ?>carrito/delete&index=<?= $indice ?>">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
    <a href="<?= base_url ?>carrito/delete_all" class="carrito-opciones vaciar">Vaciar</a>
    <a href="<?= base_url ?>Pedido/hacer" class="carrito-opciones">Hacer pedido</a>
    <div class="total-carrito">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>PRECIO TOTAL: $<?= $stats['total'] ?></h3>
    </div>
    <div class="clearfix"></div>

<?php else : ?>
    <p class="parrafo-carrito">El carrito está vació, añade algún producto</p>
<?php endif; ?>