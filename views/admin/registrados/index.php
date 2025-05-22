<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/registrados/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir usuario
    </a>
</div>

<div class="buscador">
    <input type="text" id="inputBusqueda" placeholder="Buscar..." />
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($usuarios)) { ?>
        <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre completo</th>
                        <th scope="col" class="table__th">Correo</th>
                        <th scope="col" class="table__th">Estatus</th>
                        <th scope="col" class="table__th">Tipo de usuario</th>
                        <th scope="col" class="table__th"></th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($usuarios as $usuario) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo htmlspecialchars($usuario->nombre . " " . $usuario->apellido); ?>
                            </td>
                            <td class="table__td">
                                <?php echo htmlspecialchars($usuario->email); ?>
                            </td>
                            <td class="table__td <?php echo htmlspecialchars($usuario->getEstatusClass()); ?>">
                                <?php echo htmlspecialchars($usuario->getEstatusText()); ?>
                            </td>
                            <td class="table__td">
                                <?php echo htmlspecialchars($usuario->getRolText()); ?>
                            </td>

                            <td class="table__td--acciones">
                                <a class="table__accion table__accion--editar" href="/admin/registrados/editar?id=<?php echo $usuario->IDusuario; ?>"> 
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar 
                                </a>

                                <form method="POST" action="/admin/registrados/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $usuario->IDusuario; ?>">
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
        <p class="text-center">No hay usuarios en existencia aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>