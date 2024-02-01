<h3 class="titulo">Detalle del pedido</h3>

<?php if (isset($pedido)): ?>
    <?php if(isset($_SESSION['administrador'])): ?>
        <div class="c-estado">
            <h3 class="c-estado__titulo">Cambiar el estado del pedido</h3>
            <form action="<?=base_url?>Pedido/estado" method="POST">
                <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
                <select name="estado" class="c-estado__opciones">
                    <option value="confirm" <?=$pedido->estado == 'confirm' ? 'selected' : ''?>>Pendiente</option>
                    <option value="preparation" <?=$pedido->estado == 'preparation' ? 'selected' : ''?>>En preparacion</option>
                    <option value="ready" <?=$pedido->estado == 'ready' ? 'selected' : ''?>>Preparado</option>
                    <option value="sended" <?=$pedido->estado == 'sended' ? 'selected' : ''?>>Enviado</option>
                </select>
                <input type="submit" class="c-estado__btn" value="CAMBIAR ESTADO">
            </form>
        </div>
    <?php endif; ?>
<div class="detalle-pedido">
    <h3 class="detalle-pedido__titulo">Datos del usuario</h3>
    <p><b>Nombre:</b> <?=$pedido->nombre?></p>
    <p><b>Correo:</b> <?=$pedido->correo?></p>
    <p><b>Telefono:</b> <?=$pedido->telefono?></p>
    <!-- ---------------------------------------------------------------------  -->
    <h3 class="detalle-pedido__titulo">Direccion del envio</h3>
    <p><b>Municipio:</b> <?=$pedido->municipio?></p>
    <p><b>Localidad:</b> <?=$pedido->localidad?></p>
    <p><b>Direccion:</b> <?=$pedido->direccion?></p>
    <p><b>Referencia:</b> <?=$pedido->referencia?></p>

    <!-- ---------------------------------------------------------------------  -->
    <h3 class="detalle-pedido__titulo">Datos del pedido: </h3>
    <p><b>Estado:</b> <?=Utils::showStatus($pedido->estado)?></p>
    <p><b>Numero de pedido:</b> <?=$pedido->id?></p>
    <p><b>Total a pagar:</b>$<?=$pedido->coste?> </p>
</div>

<h3 class="titulo">Productos:</h3>
<table class="tabla">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($producto = $productos->fetch_object()): ?>
        <tr>
            <td>
                <?php if ($producto->imagen != null): ?>
                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Imagen del producto" class="img_carrito">
                <?php else: ?>
                <img src="<?=imagen_defecto?>" alt="Imagen del producto" class="img_carrito">
                <?php endif;?>
            </td>
            <td>
                <a href="<?=base_url?>/producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
            </td>
            <td>
                <?=$producto->precio?>
            </td>
            <td>
                <?=$producto->unidades?>
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
<?php if($pedido->estado != 'PAGADO'): ?>
<h3 class="titulo">Realiza tu pago para empresar a procesar tu compra</h3>
<div class="PayPal">
    <script src="https://www.paypal.com/sdk/js?client-id=AWKi01rBS1Oxv_4A5Iecl2OA_mUda_wiT0UUB0qwc-Usn1PY9qb5EqlYHG95U2HRvuygkVyQpEFMcKla&currency=MXN"></script>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            style: {
                color: "blue",
                shape: "pill",
                label: "pay",
            },
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $pedido->coste ?>
                        }
                    }
                    ]
                });
            },
            onApprove: function (data, actions) {
                actions.order.capture().then(function (details) {
                    let id_transaccion = details.id;
                    let fecha = encodeURIComponent(details.create_time);
                    let status = details.status;
                    let email = encodeURIComponent(details.payer.email_address);
                    let id_cliente = details.payer.payer_id;
                    let total = encodeURIComponent(details.purchase_units[0].amount.value);
                    location.href = "<?=base_url?>Pago/guardar&pedido_id=<?=$pedido->id?>&id_transaccion=" + id_transaccion + "&fecha=" + fecha + "&status=" + status
                    + "&email=" + email + "&id_cliente=" + id_cliente + "&deposito=" + total + "&pedido_coste=<?=$pedido->coste?>";                    
                });
            },
            onCancel: function (data) {
                alert('Hello');
                console.log(data);
            }
        }).render("#paypal-button-container");
    </script>
</div>
<?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
<h1>Tu pedido No ha podido realizarce</h1>
<?php endif;?>