<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] = 'complete'): ?>
    <div class="pedido-gestion">
        <h1>Realiza el pago, por favor</h1>
        <p>
            Los datos del envio han sido guardados, para finalizar realiza el pago.
        </p>
    </div>
    <?php if (isset($pedido)): ?>
        <div id="contenedor-pedido">
            <h3>Datos del pedido</h3>
            <p>Numero de pedido: <?=$pedido->id?></p>
            <p>Total a pagar: <?=$pedido->coste?></p>
            <h3>Productos:</h3>
        </div>
        <table class="tabla">
            <thead>
                <tr>
                    <th>Producto</th>
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
                                <img src="<?=base_url?>assets/imagenes/camiseta.png" alt="Imagen del producto" class="img_carrito">
                            <?php endif;?>
                        </td>
                        <td  class="td-pedido">
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
    <?php endif;?>
    <h3 class="titulo">Paga con PayPal</h3>
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
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu pedido No ha podido realizarce</h1>
<?php endif;?>