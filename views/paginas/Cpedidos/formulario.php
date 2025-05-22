<?php
session_start();
?>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Pedido</legend>

    <div class="formulario__campo">
        <label for="usuarioNombreCompleto" class="formulario__label">Usuario:</label>
        <input type="text" id="usuarioNombreCompleto" name="usuarioNombreCompleto" class="formulario__input" 
            value="<?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?>" readonly>
    </div>

    <input type="hidden" id="usuarioID" name="usuarioID" value="<?php echo htmlspecialchars($_SESSION['IDusuario']); ?>">

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
        <label for="descripcion" class="formulario__label">Descripción del pedido (descripción detallada):</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Describe el contenido de tu producto a pedir"
            rows="6"
        ><?php echo htmlspecialchars($pedido->descripcion ?? ''); ?></textarea>
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
        <label for="direccion" class="formulario__label">Domicilio (describe algún detalle de tu ubicación):</label>
        <textarea 
            class="formulario__input"
            id="direccion"
            name="direccion"
            placeholder="Detalle para ubicar el lugar"
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
        <label for="formaPago" class="formulario__label">Forma de pago:</label>
        <select id="formaPago" name="formaPago" class="formulario__input">
            <option value="">--Selecciona una forma de pago--</option>
            <option value="Efectivo" <?php echo ($pedido->formaPago === 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
            <option value="Tarjeta" <?php echo ($pedido->formaPago === 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
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
        <label for="IDenvio" class="formulario__label">Seleccionar tipo de envío:</label>
        <select id="IDenvio" name="IDenvio" class="formulario__input">
            <option value="">--Selecciona un tipo de envío--</option>
            <?php foreach($tiposDeEnvio as $envio): ?>
                <option value="<?php echo $envio->IDenvio; ?>">
                    <?php echo htmlspecialchars($envio->tipo_envio . " - $" . number_format($envio->costo, 2)); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>
