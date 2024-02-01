<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url ?>/assets/css/normalize.css" />
    <link rel="stylesheet" href="<?= base_url ?>/assets/css/font-awesome.min.css" />
    <script src="<?= base_url ?>/assets/alert/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?= base_url ?>/assets/css/styles.css?v=<?= time(); ?>" />
    <title>The Blossom</title>
</head>

<body>
    <header class="header">
        <div class="contenedor">
            <div class="grupouno">
                <div class="logo">
                    <a href="<?= base_url ?>"><img class="logo__imagen" src="<?= base_url ?>imagenes/logo.bmp" alt="The Blossom" title="The Blossom" /></a>
                </div>
                <div class="barra">
                    <h1 class="barra__slogan">
                        "The Blossom moda y comodidad para tí"
                    </h1>
                    <form class="barra__busqueda" action="<?= base_url ?>Producto/busqueda" method="POST">
                        <input class="barra__busqueda-input" type="text" placeholder="Buscar productos" name="buscar" id="buscar" />
                        <button><i class="barra__busqueda-icono fa fa-search"></i></button>
                    </form>
                </div>
                <nav class="sesion">
                    <input type="checkbox" name="sesion__checkbox" id="sesion__checkbox">
                    <label for="sesion__checkbox" class="sesion__toggle">
                        <i class="close fa fa-times" aria-hidden="true"></i>
                        <i class="menu fa fa-bars" aria-hidden="true"></i>
                    </label>
                    <ul class="sesion__menu">
                        <?php if (isset($_SESSION['identity'])) : ?>
                            <a href="#"><?= $_SESSION['identity']->nombre ?></a>
                            <a href="<?= base_url ?>/Usuario/logOut">CERRAR SESIÓN</a>
                        <?php else : ?>
                            <a href="<?= base_url ?>/Usuario/signIn">CREAR CUENTA</a>
                            <a href="<?= base_url ?>/Usuario/logIn">INGRESA</a>
                        <?php endif; ?>
                        <a href="<?= base_url ?>carrito/index">
                            <i class="sesion__carrito-icono fa fa-car" aria-hidden="true"></i>
                        </a>
                    </ul>
                </nav>
            </div>
            <?php $categorias = Utils::showCategorias(); ?>
            <div class="navegacion">
                <nav class="nav-categ">
                    <?php while ($categoria = $categorias->fetch_object()) : ?>
                        <a href="<?= base_url ?>categoria/ver&id=<?= $categoria->id ?>" class="nav-categ__opcion"><?= $categoria->nombre ?></a>
                    <?php endwhile; ?>
                    <a href="<?= base_url ?>Producto/oferta" class="nav-categ__opcion">DESCUENTOS</a>
                    <a href="<?= base_url ?>Categoria/mostrar" class="nav-categ__opcion azul">MAS CATEGORIAS</a>
                    <a href="<?= base_url ?>Contacto/index" class="nav-categ__opcion azul">CONOCENOS</a>
                </nav>
                <nav class="nav-gest">
                    <ul>
                        <li class="nav-gest__opcion"><a href="#">TU CUENTA</a>
                            <ul class="nav-gest__ul">
                                <?php if (isset($_SESSION['administrador']) && $_SESSION['administrador'] == true) : ?>
                                    <li class="nav-gest__opcion"><a href="<?= base_url ?>Categoria/gestionar">MANTENER CATEGORIAS</a></li>
                                    <li class="nav-gest__opcion"><a href="<?= base_url ?>Producto/gestion">MANTENER PRODUCTOS</a></li>
                                    <li class="nav-gest__opcion"><a href="<?= base_url ?>Pedido/gestion">MANTENER PEDIDOS</a></li>
                                    <li class="nav-gest__opcion"><a href="<?= base_url ?>Usuario/gestionar">MANTENER USUARIOS</a></li>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['identity'])) : ?>
                                    <li class="nav-gest__opcion"><a href="<?= base_url ?>Usuario/update&id=<?= $_SESSION['identity']->id ?>">CONFIGURACIÓN</a></li>
                                <?php endif; ?>
                                <li class="nav-gest__opcion"><a href="<?= base_url ?>Pedido/mis_pedidos">MIS PEDIDOS</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="contenedor">