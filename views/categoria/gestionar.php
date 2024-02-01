
    <h2 class="titulo">GESTIONAR CATEGORIAS</h2>
    <a href="<?=base_url?>Categoria/crear" class="accion-boton">CREAR CATEGORÍA</a>

<?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'complete') : ?>
    <strong class="alert green">La categoría se ha añadido correctamente.</strong>
<?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] != 'complete') : ?>
    <strong class="alert red">La categoría NO se ha añadido correctamente.</strong>
<?php endif; ?>
<?php Utils::deleteSession('categoria'); ?>
<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert green">La categoría se ha borrado correctamente.</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
    <strong class="alert red">La categoría NO se ha borrado correctamente.</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($categoria = $categorias->fetch_object()) : ?>
            <tr>
                <td><?=$categoria->id?></td>
                <td><?=$categoria->nombre?></td>
                <td>
                    <a class="tabla__btn" href="<?=base_url?>Categoria/update&id=<?=$categoria->id?>">EDITAR</a>
                    <a class="tabla__btn rojo" href="<?=base_url?>Categoria/delete&id=<?=$categoria->id?>">ELIMINAR</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>