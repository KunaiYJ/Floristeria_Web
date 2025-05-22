<h2 class="ventas-dashboard__heading"><?php echo $titulo; ?></h2>

<div class="ventas-contenedor">
    <div class="ventas-buscador">
        <input type="text" placeholder="Buscar producto..." id="buscador">
    </div>

    <div class="ventas-categorias">
        <h3>Categorías</h3>
        <button class="ventas-categoria" data-id="todos">Todos</button>
        <?php foreach ($categorias as $categoria): ?>
            <button class="ventas-categoria" data-id="<?php echo $categoria->IDcategoria; ?>">
                <?php echo $categoria->nombre; ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div class="ventas-productos">
        <?php foreach ($productos as $producto) : ?>
            <div class="ventas-producto" data-id="<?php echo $producto->IDproducto; ?>" data-precio="<?php echo $producto->precio; ?>" data-categoria="<?php echo $producto->IDcategoria; ?>">
                <picture>
                    <source srcset="/img/products/<?php echo $producto->imagen; ?>.webp" type="image/webp">
                    <source srcset="/img/products/<?php echo $producto->imagen; ?>.jpg" type="image/jpg">
                    <img class="producto-imagen" loading="lazy" src="/img/products/<?php echo $producto->imagen; ?>.png" alt="<?php echo $producto->nombreProducto; ?>">
                </picture>
                <div><?php echo $producto->nombreProducto; ?></div>
                <div>Cantidad disponible: <?php echo $producto->stock; ?></div>
                <div>Precio: $<?php echo number_format($producto->precio, 2); ?></div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="ventas-seccion-venta">
        <div class="ventas-clientes">
            <label for="cliente">Selecciona el cliente para la venta:</label>
            <select name="cliente" id="cliente">
                <option value="">Seleccionar cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente->IDcliente; ?>"><?php echo $cliente->nombre; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="ventas-detalle-venta">
            <div class="ventas-encabezado">
                <span>Producto</span>
                <span>Cantidad.</span>
                <span>Precio</span>
                <span>Subtotal</span>
                <span></span>
            </div>

            <div class="ventas-productos-seleccionados">
                <!-- Aquí irán los productos seleccionados -->
            </div>

            <div class="ventas-total">
                <span>Total de venta:</span>
                <span id="totalDisplay">$0.00</span>
            </div>
        </div>

        <div class="ventas-acciones">
            <button class="boton-limpiar">LIMPIAR LISTA</button>
            <button class="boton-vender">REALIZAR VENTA</button>
        </div>
    </div>
</div>
