<main class="contenedor seccion">
    <h1>Productos en Venta.</h1>

    <div class="contenedor-anuncios">
        <?php foreach($productos as $producto) { ?>

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
</main>