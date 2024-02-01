<?php if (isset($gestion)) : ?>
    <div class="pedido-gestion">
        <h1>Gestionar pedidos</h1>
    </div>

    <form action="<?= base_url ?>Pedido/gestion" id="formulario" method="POST" enctype="multipart/form-data">
        <!-- Grupo: Fecha1 -->
        <div class="formulario__grupo" id="grupo__fecha">
            <label for="fecha" class="formulario__label">Seleccione la fecha para gestionar los pedidos</label>
            <div class="formulario__grupo-input">
                <?php $fechas = Utils::showFechas(); ?>
                <select class="formulario__input" name="fecha" id="fecha">

                    <?php while ($fet = $fechas->fetch_object()) : ?>
                        <option value="<?= $fet->fecha ?>">
                            <?= $fet->fecha ?>
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
            <button type="submit" class="formulario__btn">APLICAR</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                Formulario enviado exitosamente!
            </p>
        </div>
    </form>
    <form action="<?= base_url ?>Pedido/gestion" id="formulario" method="POST" enctype="multipart/form-data">
        <!-- Grupo: Fecha2 -->
        <div class="formulario__grupo" id="grupo__fecha2">
            <label for="fecha2" class="formulario__label">Seleccione el día para gestionar los pedidos</label>
            <div class="formulario__grupo-input">
                <input type="date" class="formulario__input" id="fecha2" name="fecha2" />
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
            <button type="submit" class="formulario__btn">APLICAR</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">
                Formulario enviado exitosamente!
            </p>
        </div>
    </form>
<?php else : ?>
    <div class="pedido-gestion">
        <h1>Mis pedidos</h1>
    </div>
<?php endif; ?>

<table class="tabla">
    <tr>
        <th>No Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php while ($pedido = $pedidos->fetch_object()) : ?>
        <tr>
            <td>
                <a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id ?>">
                    <?= $pedido->id ?>
                </a>
            </td>
            <td>
                $<?= $pedido->coste ?>
            </td>
            <td>
                <?= $pedido->fecha ?>
            </td>
            <td>
                <?= Utils::showStatus($pedido->estado) ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>