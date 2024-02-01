    </div>
    </main>
    <footer class="footer">
        <div class="footer__texto contenedor">
            Todos los derechos reservados a The Blossom
        </div>
    </footer>
    <?php if (isset($_GET['controller']) && isset($_GET['action'])) : ?>
        <?php if ($_GET['controller'] == 'Usuario'  && $_GET['action'] == 'signIn') : ?>
            <script src="<?= base_url ?>assets/js/registro_usuario.js?=<?= time() ?>"></script>
            <script src="<?= base_url ?>assets/js/show_password.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Usuario'  && $_GET['action'] == 'logIn') : ?>
            <script src="<?= base_url ?>assets/js/iniciar_sesion.js?=<?= time() ?>"></script>
            <script src="<?= base_url ?>assets/js/show_password.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Usuario'  && $_GET['action'] == 'update') : ?>
            <script src="<?= base_url ?>assets/js/modificar_usuario.js?=<?= time() ?>"></script>
            <script src="<?= base_url ?>assets/js/show_password.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Usuario'  && $_GET['action'] == 'change') : ?>
            <script src="<?= base_url ?>assets/js/confirmar_password.js?=<?= time() ?>"></script>
            <script src="<?= base_url ?>assets/js/show_password.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Categoria'  && $_GET['action'] == 'crear') : ?>
            <script src="<?= base_url ?>assets/js/crear_categoria.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Pedido'  && $_GET['action'] == 'hacer') : ?>
            <script src="<?= base_url ?>assets/js/confirmar_pedido.js?=<?= time() ?>"></script>
        <?php elseif ($_GET['controller'] == 'Producto'  && $_GET['action'] == 'crear') : ?>
            <script src="<?= base_url ?>assets/js/crear_producto.js?=<?= time() ?>"></script>
        <?php endif; ?>

    <?php endif; ?>
    <?php if (
        !isset($_GET['controller']) && !isset($_GET['action']) &&
        isset($_SESSION['register']) && $_SESSION['register'] == 'complete'
    ) : ?>
        <script>
            swal('El usuario ha sido creado, por favor logueate.');
        </script>
        <?php Utils::deleteSession('register'); ?>
    <?php endif; ?>
    </body>

    </html>