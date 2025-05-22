<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/clientes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir cliente
    </a>
</div>

<div class="buscador">
    <input type="text" id="inputBusqueda" placeholder="Buscar..." />
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($clientes)) { ?>
        <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre completo</th>
                        <th scope="col" class="table__th">Teléfono</th>
                        <th scope="col" class="table__th">Dirección</th>
                        <th scope="col" class="table__th"></th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($clientes as $cliente) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo htmlspecialchars($cliente->nombre); ?>
                            </td>
                            <td class="table__td">
                                <?php echo htmlspecialchars($cliente->telefono); ?>
                            </td>
                            <td class="table__td">
                                <?php echo htmlspecialchars($cliente->direccion); ?>
                            </td>

                            <td class="table__td--acciones">
                                <a class="table__accion table__accion--editar" href="/admin/clientes/editar?id=<?php echo $cliente->IDcliente; ?>"> 
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar 
                                </a>

                                <form method="POST" action="/admin/clientes/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $cliente->IDcliente; ?>">
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
        <p class="text-center">No hay clientes en existencia aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>