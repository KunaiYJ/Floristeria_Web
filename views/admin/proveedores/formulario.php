<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del proveedor</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del proveedor:</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre(s) del proveedor"
            value="<?php echo htmlspecialchars($proveedor->nombre ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="telefono" class="formulario__label">Teléfono:</label>
        <input 
            type="number"
            class="formulario__input"
            id="telefono"
            name="telefono"
            placeholder="Teléfono del proveedor"
            value="<?php echo htmlspecialchars($proveedor->telefono ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="direccion" class="formulario__label">Dirección (específica):</label>
        <textarea 
            class="formulario__input"
            id="direccion"
            name="direccion"
            placeholder="Dirección del proveedor"
            rows="6"
        ><?php echo htmlspecialchars($proveedor->direccion ?? ''); ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="ciudad" class="formulario__label">Ciudad:</label>
        <input 
            type="text"
            class="formulario__input"
            id="ciudad"
            name="ciudad"
            placeholder="ciudad del proveedor"
            value="<?php echo htmlspecialchars($proveedor->ciudad ?? ''); ?>"
        />
    </div>
</fieldset>