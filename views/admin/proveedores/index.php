<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/proveedores/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir proveedor
    </a>
</div>

<div class="buscador">
    <input type="text" id="inputBusqueda" placeholder="Buscar..." />
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($proveedores)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre del proveedor</th>
                    <th scope="col" class="table__th">Teléfono</th>
                    <th scope="col" class="table__th">Dirección</th>
                    <th scope="col" class="table__th">Ciudad</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($proveedores as $proveedor) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo htmlspecialchars($proveedor->nombre); ?>
                        </td>
                        <td class="table__td">
                            <?php echo htmlspecialchars($proveedor->telefono); ?>
                        </td>
                        <td class="table__td">
                            <?php echo htmlspecialchars($proveedor->direccion); ?>
                        </td>
                        <td class="table__td">
                            <?php echo htmlspecialchars($proveedor->ciudad); ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/proveedores/editar?id=<?php echo $proveedor->IDproveedor; ?>"> 
                                <i class="fa-solid fa-user-pen"></i>
                                Editar 
                            </a>
                            <form method="POST" action="/admin/proveedores/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $proveedor->IDproveedor; ?>">
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
        <p class="text-center">No hay proveedores en existencia aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>