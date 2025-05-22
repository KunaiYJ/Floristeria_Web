<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Cliente</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre(s) del cliente:</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre(s) del cliente"
            value="<?php echo htmlspecialchars($cliente->nombre ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="telefono" class="formulario__label">Teléfono celular:</label>
        <input 
            type="number"
            class="formulario__input"
            id="telefono"
            name="telefono"
            placeholder="Teléfono del cliente"
            value="<?php echo htmlspecialchars($cliente->telefono ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="direccion" class="formulario__label">Dirección (descripción de la casa):</label>
        <textarea 
            class="formulario__input"
            id="direccion"
            name="direccion"
            placeholder="Dirección del cliente"
            rows="6"
        ><?php echo htmlspecialchars($cliente->direccion ?? ''); ?></textarea>
    </div>


</fieldset>