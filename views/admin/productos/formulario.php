<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Producto</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Producto:</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombreProducto"
            placeholder="nombre del producto"
            value="<?php echo $producto->nombreProducto ?? ''; ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción del Producto:</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="descripción del producto"
            rows="6"
        ><?php echo $producto->descripcion ?? ''; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen:</label>
        <input 
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        />
    </div>

    <?php if(isset($producto->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Acutal:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/products/' . $producto->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/products/' . $producto->imagen; ?>.jgp" type="image/jgp">
                <img src="<?php echo $_ENV['HOST'] . '/img/products/' . $producto->imagen; ?>.jpg" alt="Imagen Producto">
            </picture>
        </div>
    <?php } ?>
</fieldset>

    <fieldset class="formulario__fieldset">
        <legend class="formulario__legend">Tipo de Flores del Ramo</legend>
    
        <div class="formulario__campo">
            <label for="tags_input" class="formulario__label">Ingresa las flores <span class="mensaje">( separadas por coma )</span> :</label>
            <input 
                type="text"
                class="formulario__input"
                id="tags_input"
                placeholder="Ej. Tulipan, Orquidea, Rosa"
            >
            
            <div id="tags" class="formulario__listado"></div>
            <input type="hidden" name="tags" value="<?php echo $producto->tags ?? ''; ?>">
        </div>
    </fieldset>

<fieldset class="formulario__fieldset">

    <div class="formulario__grupo-campos">
        <div class="formulario__campo">
            <label for="cantflores" class="formulario__label">Cantidad de flores en el ramo:</label>
            <input 
                type="number"
                class="formulario__input"
                id="cantflores"
                name="cantidad_flores"
                placeholder="cantidad de flores del ramo"
                value="<?php echo $producto->cantidad_flores ?? ''; ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="precio" class="formulario__label">Precio del producto:</label>
            <input 
                type="number"
                class="formulario__input"
                id="precio"
                name="precio"
                placeholder="precio del producto"
                value="<?php echo $producto->precio ?? ''; ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="stock" class="formulario__label">Stock actual disponible:</label>
            <input 
                type="number"
                class="formulario__input"
                id="stock"
                name="stock"
                placeholder="stock actual"
                value="<?php echo $producto->stock ?? ''; ?>"
            />
        </div>
    </div>

    <div class="formulario__campo">
        <label for="proveedor" class="formulario__label">Proveedor:</label>
        <select id="proveedor" name="IDproveedor" class="formulario__input">
            <option value="">--Selecciona un Proveedor--</option>
            <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?php echo $proveedor->IDproveedor; ?>" 
                    <?php echo ($producto->IDproveedor == $proveedor->IDproveedor) ? 'selected' : ''; ?>>
                    <?php echo $proveedor->nombre; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoría del Producto:</label>
        <select id="categoria" name="IDcategoria" class="formulario__input">
            <option value="">--Selecciona una Categoría--</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria->IDcategoria; ?>" 
                    <?php echo ($producto->IDcategoria == $categoria->IDcategoria) ? 'selected' : ''; ?>>
                    <?php echo $categoria->nombre; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

</fieldset>