<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton dashboard__boton--izquierdo" href="/admin/categorias/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Categoría
    </a>    

    <a class="dashboard__boton" href="/admin/productos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Producto
    </a>
</div>

<div class="buscador">
    <input type="text" id="inputBusqueda" placeholder="Buscar productos o categorías..." />
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($productos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Producto</th>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th">Flores</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th">Cant. de Flores</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Stock</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($productos as $producto) { ?>

                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $producto->nombreProducto ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->descripcion ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->tags ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->IDcategoria ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->cantidad_flores ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->precio ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->stock ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/productos/editar?id=<?php echo $producto->IDproducto; ?>"> 
                                <i class="fa-solid fa-user-pen"></i>
                                Editar 
                            </a>

                            <button class="table__accion table__accion--gestionar" onclick="abrirModal(<?php echo $producto->IDproducto; ?>, '<?php echo $producto->cantidad_flores; ?>', '<?php echo $producto->stock; ?>')">
                                <i class="fa-solid fa-box"></i> Gestionar Inventario
                            </button>

                            <form method="POST" action="/admin/productos/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $producto->IDproducto; ?>">
                                <input type="hidden" name="eliminar_producto" value="1"> <!-- Esto indica que es un producto -->
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No se encuentran productos registrados aún</p>
    <?php } ?>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($categorias)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre de categoría</th>
                    <th scope="col" class="table__th">Descripción de categoría</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($categorias as $categoria) { ?>

                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $categoria->nombre ?>
                        </td>
                        <td class="table__td">
                            <?php echo $categoria->descripcion ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/categorias/editar?id=<?php echo $categoria->IDcategoria; ?>"> 
                                <i class="fa-solid fa-user-pen"></i>
                                Editar 
                            </a>

                            <form method="POST" action="/admin/categorias/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $categoria->IDcategoria; ?>">
                                <input type="hidden" name="tipo" value="categoria">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No se encuentran categorías registradas aún</p>
    <?php } ?>
</div>

<!-- Modal para gestionar el inventario -->
<div id="modal-inventario" class="modal">
    <div class="modal__contenido">
        <span class="modal__cerrar" onclick="cerrarModal()">&times;</span>
        <h2>Gestionar Inventario</h2>

        <form id="formularioInventario" action="/admin/productos/actualizar_inventario" method="POST">
            <input type="hidden" name="id" id="id_producto_modal">
            
            <div class="campo">
                <label for="cantidad_flores">Cantidad de flores (a agregar)</label>
                <input type="number" id="cantidad_flores" name="cantidad_flores" min="0" required>
            </div>

            <div class="campo">
                <label for="stock">Cantidad en inventario (a agregar)</label>
                <input type="number" id="stock" name="stock" min="0" required>
            </div>

            <button type="submit" class="btn">Actualizar Inventario</button>
        </form>
    </div>
</div>

<?php
    echo $paginacion;
?>
