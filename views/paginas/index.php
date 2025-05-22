<main class="home">
    <section class="floristeria__contenedor">
        <h1>¿Por qué elegir a La Floristería?</h1>

        <div class="floristeria__seccion">
            <div class="cuadro">
                <picture>
                    <source srcset="build/img/calidad.avif" type="image/avif">
                    <source srcset="build/img/calidad.webp" type="image/webp">
                    <img loading="lazy" src="build/img/calidad.png" alt="Imagen Floristeria">
                </picture>
                <h3>Calidad</h3>
                <p>
                    Cada ramo es elaborado con esmero, utilizando flores frescas y de alta calidad. 
                    Nos enfocamos en crear arreglos únicos, cuidando cada detalle, para que nuestros clientes reciban 
                    un producto excepcional que deje una impresión duradera..
                </p>
            </div>
            <div class="cuadro">
                <picture>
                    <source srcset="build/img/etiqueta-del-precio.avif" type="image/avif">
                    <source srcset="build/img/etiqueta-del-precio.webp" type="image/webp">
                    <img loading="lazy" src="build/img/etiqueta-del-precio.png" alt="Imagen Floristeria">
                </picture>
                <h3>Precio</h3>
                <p>
                    Ofrecemos ramos que se adaptan a distintos presupuestos, manteniendo siempre la mejor calidad. 
                    Desde opciones accesibles hasta arreglos exclusivos, cada ramo refleja cuidado y elegancia, 
                    asegurando la plena satisfacción de nuestros clientes.
                </p>
            </div>
            <div class="cuadro">
                <picture>
                    <source srcset="build/img/gestion-del-tiempo.avif" type="image/avif">
                    <source srcset="build/img/gestion-del-tiempo.webp" type="image/webp">
                    <img loading="lazy" src="build/img/gestion-del-tiempo.png" alt="Imagen Floristeria">
                </picture>
                <h3>Tiempo</h3>
                <p>
                    Nos esforzamos por ofrecer un servicio rápido sin comprometer la calidad. 
                    Cada ramo es elaborado en el menor tiempo posible, con atención meticulosa a cada detalle, 
                    para asegurar que nuestros clientes reciban sus flores frescas y listas a tiempo para cualquier 
                    ocasión especial.
                </p>
            </div>
        </div>
    </section>
</main>

<section class="seccion contenedor">
    <h2>Demostración de Productos</h2>

    <div class="contenedor-anuncios">
        <?php 
        shuffle($productos);

        $productosRandom = array_slice($productos, 0, 3);

        foreach($productosRandom as $producto) { ?>
            <div class="anuncio">
                <picture>
                    <source srcset="img/products/<?php echo $producto->imagen; ?>.webp" type="image/webp">
                    <source srcset="img/products/<?php echo $producto->imagen; ?>.jpg" type="image/jpg">
                    <img class="speaker__imagen" loading="lazy" width="200" height="300" src="img/products/<?php echo $producto->imagen; ?>.png" alt="Imagen Producto">
                </picture>

                <div class="contenido-anuncio">
                    <h3><?php echo $producto->nombreProducto ?></h3>
                    <p><?php echo $producto->descripcion?></p>
                    <p class="precio">$<?php echo $producto->precio ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img loading="lazy" src="build/img/florcant.png" alt="icono flor">
                            <p>Cantidad de flores: <?php echo $producto->cantidad_flores ?></p>
                        </li>
                    </ul>

                    <ul class="anuncio__listado-tags">
                        <?php 
                            $tags = explode(',', $producto->tags);
                            foreach($tags as $tag) { 
                        ?>
                            <li class="anuncio__tags"><?php echo $tag; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="alinear-derecha">
        <a href="/productos" class="boton-verde">Ver Todos</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Regala ese ramo especial</h2>
    <p>Llena el formulario de contacto para ponernos en contacto contigo</p>
    <a href="/contacto" class="boton-morado">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="" alt="Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="#">
                    <h4>Como construir un ramo personalizado</h4>
                    <p>Escrito el: <span>10/09/2024</span> por: <span>Administrador</span> </p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia porro aliquam, debitis molestias facere, suscipit nemo explicabo vero nulla atque obcaecati itaque quisquam laborum tempora vitae rerum labore exercitationem!
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="" alt="Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="#">
                    <h4>Cuida tu detalle especial</h4>
                    <p>Escrito el: <span>10/09/2024</span> por: <span>Administrador</span> </p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia porro aliquam, debitis molestias facere, suscipit nemo explicabo vero nulla atque obcaecati itaque quisquam laborum tempora vitae rerum labore exercitationem!
                    </p>
                </a>
            </div>
        </article>
    </section>
    
    <section class="testimoniales">
        <h3>Recordatorios</h3>

        <div class="testimonial">
            <blockquote>
                Si vas a mirar atrás, que sea para ver lo que has trabajado para llegar a donde estás
            </blockquote>
            <p>- Fernanda</p>
        </div>
    </section>
</div>
