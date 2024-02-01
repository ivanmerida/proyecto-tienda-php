<h2 class="titulo">TODAS NUESTRAS CATEGORIAS</h2>
<div class="categorias">
    <?php while ($categoria = $categorias->fetch_object()) : ?>
        <div class="categoria">
            <div class="categoria__opcion">
                <?php if ($categoria->imagen != null) : ?>
                    <img class="categoria__opcion-imagen" src="<?= base_url ?>uploads/categoria-images/<?= $categoria->imagen ?>" alt="Imagen del producto">
                <?php else : ?>
                    <img class="categoria__opcion-imagen" src="<?= base_url ?>imagenes/productos/vestido.bmp" alt="">
                <?php endif; ?>
                <a href="<?= base_url ?>categoria/ver&id=<?= $categoria->id ?>">
                    <span class="categoria__opcion-nombre"><?= $categoria->nombre ?></span>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>