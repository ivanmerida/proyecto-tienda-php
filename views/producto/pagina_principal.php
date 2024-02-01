
            <div id="container-slider">
                <ul class="slider">
                    <li id="slide1">
                        <h1>Bienvenidos</h1>
                        <img src="<?= base_url ?>imagenes/slider/img1.jpg" />
                    </li>
                    <li id="slide2">
                        <img src="<?= base_url ?>imagenes/slider/img2.jpg" />
                    </li>
                    <li id="slide3">
                        <img src="<?= base_url ?>imagenes/slider/img3.jpg" />
                    </li>
                    <!--
                    <li id="slide3">
                        <h1>Ejemplo con otros elementos</h1>
                        <p>Esto es un párrafo de ejemplo para comprobar que podemos meter cualquier tipo de elementos en el slider</p>
                        <a href="https://kikopalomares.com/">¡Corre a mi web para más contenido!</a>
                    </li>
-->
                </ul>

                <ul class="menu">
                    <li>
                        <a href="#slide1">1</a>
                    </li>
                    <li>
                        <a href="#slide2">2</a>
                    </li>
                    <li>
                        <a href="#slide3">3</a>
                    </li>
                </ul>
            </div>
            <h2 class="titulo">ELIGE POR CATEGORIA</h2>
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
            <div class="seccion-personalizada">
                <h3 class="titulo">SECCIÓN PERSONALIZADA PARA TI</h3>
                <div class="productos">
                    <?php while ($producto = $productos->fetch_object()) : ?>
                        <div class="producto">
                            <?php if ($producto->imagen != null) : ?>
                                <img class="producto__imagen" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen del producto">
                            <?php else : ?>
                                <img class="producto__imagen" src="<?= base_url ?>imagenes/productos/playera__gucci.bmp" alt="Una playera Gucci">
                            <?php endif; ?>
                            <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>">
                                <span class="producto__nombre"><?= $producto->nombre ?></span>
                                <span class="producto__descripcion"><?= $producto->descripcion ?></span>
                                <span class="producto__precio">$<?= $producto->precio ?></span>
                            </a>
                        </div>
                    <?php endwhile ?>
                </div>
            </div>
            <div class="ubicacion">
                <h3 class="titulo">UBICACIÓN</h3>
                <div class="informacion">
                    <div class="informacion__direccion">
                        <p class="informacion__calle">Lorem ipsum dolor sit amet.</p>
                        <p class="informacion__telefono">(503) 400-5479</p>
                    </div>
                    <div class="informacion__horarios">
                        <h4 class="informacion__horarios-titulo">HORARIOS</h4>
                        <div class="informacion__horarios-dias">
                            <p class="informacion__horarios-texto">LUNES A SABADO <br>9:00 A.M. - 7 P.M.</p>
                            <p class="informacion__horarios-texto">DOMINGO <br>SIN SERVICIO</p>
                        </div>
                    </div>
                </div>
                <div class="ubicacion">
                    <img src="<?= base_url ?>imagenes/google__maps-ubicacion.bmp" alt="">
                    
                </div>
            </div>
            <div class="about">
                <div class="about__logo">
                    <img class="about__logo-imagen" src="<?= base_url ?>imagenes/logo__grande.bmp" alt="">
                </div>
                <div class="about__informacion">
                    <h4 class="about__titulo">SOBRE NOSOTROS</h4>
                    <p class="about__texto">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam quam
                        debitis laboriosam aut cupiditate nostrum error placeat eveniet velit
                        dolores beatae repudiandae nihil corrupti, non ducimus voluptates
                        itaque. Sunt ut consequatur sit, maiores esse distinctio!</p>
                </div>
            </div>