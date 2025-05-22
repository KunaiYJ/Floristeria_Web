<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la categoría</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre de la categoría:</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre de la categoría"
            value="<?php echo htmlspecialchars($categoria->nombre ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción de la categoría:</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción de la categoría"
            rows="6"
        ><?php echo $categoria->descripcion ?? ''; ?></textarea>
    </div>
</fieldset>