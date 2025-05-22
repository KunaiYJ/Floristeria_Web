<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/pedidos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Crear Pedido
    </a>
</div>

<div class="buscador">
    <input type="text" id="inputBusqueda" placeholder="Buscar..." />
</div>

<div class="calendario-contenedor">
    <div class="calendario">
        <div id="calendar1"></div>
    </div>

    <div class="tabla-pedido">
        <div id="pedidoModal" class="modal-pedido" style="display: none;">
            <div class="modal-pedido-content">
                <span class="close-pedido">&times;</span>
                <h2>Detalles del Pedido</h2>
                <p><strong>Cliente:</strong> <span id="modalNombreCliente"></span></p>
                <p><strong>Producto:</strong> <span id="modalProducto"></span></p>
                <p><strong>Fecha de Entrega:</strong> <span id="modalFechaEntrega"></span></p>
                <p><strong>Dirección:</strong> <span id="modalDireccion"></span></p>
                <p><strong>Contacto:</strong> <span id="modalContacto"></span></p>

                <h3 id="actualizarEstadoTitulo">Actualizar Estado del Pedido</h3>
                <form id="actualizarEstadoForm" method="POST" action="/admin/pedidos/actualizarEstado">
                    <input type="hidden" id="pedidoId" name="id">
                    <select id="modalEstado" name="estado">
                        <option value="Pendiente">Pendiente</option>
                        <option value="Pagado">Pagado</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                    <button type="submit">Actualizar Estado</button>
                </form>
            </div>
        </div>

        <h3>Pedidos Actuales</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cliente/Usuario</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Modelo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?php echo isset($pedido->IDpedido) ? $pedido->IDpedido : ''; ?></td>
                    <td><?php echo isset($pedido->producto) ? $pedido->producto : ''; ?></td>
                    <td>
                        <?php
                        // Obtener el nombre del cliente o usuario
                        $nombrePersona = '--';
                        if (isset($pedido->IDcliente)) {
                            foreach ($clientes as $cliente) {
                                if ($cliente->IDcliente == $pedido->IDcliente) {
                                    $nombrePersona = $cliente->nombre; // Nombre del cliente
                                    break;
                                }
                            }
                        } elseif (isset($pedido->usuarioID)) {
                            foreach ($usuarios as $usuario) {
                                if ($usuario->IDusuario == $pedido->usuarioID) {
                                    $nombrePersona = $usuario->nombre . ' ' . $usuario->apellido; // Nombre del usuario
                                    break;
                                }
                            }
                        }
                        echo $nombrePersona;
                        ?>
                    </td>
                    <td><?php echo isset($pedido->cantidad) ? $pedido->cantidad : ''; ?></td>
                    <td><?php echo isset($pedido->fecha) ? $pedido->fecha : ''; ?></td>
                    <td><?php echo isset($pedido->IDcliente) ? 'Modelo A' : 'Modelo B'; ?></td>
                    <td>
                        <?php if (isset($pedido->IDcliente)): // Solo mostrar acciones para pedidos de Pedido ?>
                        <a href="/admin/pedidos/editar?id=<?php echo isset($pedido->IDpedido) ? $pedido->IDpedido : ''; ?>" class="btn-editar" title="Editar">
                            <i class="fa-solid fa-pencil-alt"></i>
                        </a>
                        <form method="POST" action="/admin/pedidos/eliminar" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo isset($pedido->IDpedido) ? $pedido->IDpedido : ''; ?>">
                            <button type="submit" class="btn-eliminar" title="Eliminar">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </form>
                        <?php else: ?>
                            <span>//</span> 
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
echo $paginacion;
?>
