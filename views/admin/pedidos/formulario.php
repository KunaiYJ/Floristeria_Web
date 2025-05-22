<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Pedido</legend>

    <div class="formulario__campo">
        <label for="producto" class="formulario__label">Producto a pedir:</label>
        <input 
            type="text"
            class="formulario__input"
            id="producto"
            name="producto"
            placeholder="Ingrese el producto deseado"
            value="<?php echo htmlspecialchars($pedido->producto ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="descripcionPedido" class="formulario__label">Descripción de el pedido (descripción detalladamente):</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcionPedido"
            placeholder="Describe el contenido del producto que deseas pedir"
            rows="6"
        ><?php echo htmlspecialchars($pedido->descripcionPedido ?? ''); ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="cantidad" class="formulario__label">Cantidad de ramos:</label>
        <input 
            type="number"
            class="formulario__input"
            id="cantidad"
            name="cantidad"
            placeholder="Ramos a pedir, 1, 2, etc."
            value="<?php echo htmlspecialchars($pedido->cantidad ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="direccion" class="formulario__label">Domicilio (describe algun detalle de tu ubicación):</label>
        <textarea 
            class="formulario__input"
            id="direccion"
            name="direccion"
            placeholder="Detalles para ubicar el lugar"
            rows="4"
        ><?php echo htmlspecialchars($pedido->direccion ?? ''); ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="contacto" class="formulario__label">Número de celular:</label>
        <input 
            type="number"
            class="formulario__input"
            id="contacto"
            name="contacto"
            placeholder="633 *** ****"
            value="<?php echo htmlspecialchars($pedido->contacto ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="FormaPago" class="formulario__label">Forma de pago:</label>
        <select id="FormaPago" name="FormaPago" class="formulario__input">
            <option value="">--Selecciona una Forma de Pago--</option>
            <option value="Efectivo" <?php echo $pedido->FormaPago === 'Efectivo' ? 'selected' : ''; ?>>Efectivo</option>
            <option value="Tarjeta" <?php echo $pedido->FormaPago === 'Tarjeta' ? 'selected' : ''; ?>>Tarjeta</option>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="fecha" class="formulario__label">Fecha de entrega:</label>
        <input 
            type="date" 
            id="fecha" 
            name="fecha" 
            class="formulario__input" 
            value="<?php echo $pedido->fecha ?? ''; ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="IDenvio" class="formulario__label">Seleccionar tipo de Envío:</label>
        <select id="IDenvio" name="IDenvio" class="formulario__input">
            <option value="">--Selecciona un Tipo de Envío--</option>
            <?php foreach($tiposDeEnvio as $envio): ?>
                <option value="<?php echo $envio->IDenvio; ?>">
                    <?php echo $envio->tipo_envio . " - $" . number_format($envio->costo, 2); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="IDcliente" class="formulario__label">Seleccionar usuario o cliente:</label>
        <select id="IDcliente" name="IDcliente" class="formulario__input">
            <option value="">--Selecciona un Cliente--</option>
            <optgroup label="Clientes">
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?php echo $cliente->IDcliente; ?>" 
                        <?php echo $pedido->IDcliente === $cliente->IDcliente ? 'selected' : ''; ?>>
                        <?php echo $cliente->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
        </select>
    </div>



</fieldset>