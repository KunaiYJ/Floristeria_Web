<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Usuario</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre(s):</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre(s) del usuario"
            value="<?php echo htmlspecialchars($usuarios->nombre ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido(s):</label>
        <input 
            type="text"
            class="formulario__input"
            id="apellido"
            name="apellido"
            placeholder="Apellido(s) del usuario"
            value="<?php echo htmlspecialchars($usuarios->apellido ?? ''); ?>"
        />
    </div>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">Correo electrónico:</label>
        <input 
            type="text"
            class="formulario__input"
            id="email"
            name="email"
            placeholder="Correo del usuario"
            value="<?php echo htmlspecialchars($usuarios->email ?? ''); ?>"
        />
    </div>

    <?php if (!isset($modoEdicion) || !$modoEdicion): ?>
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Contraseña:</label>
        <input 
            type="password"
            class="formulario__input"
            id="password"
            name="password"
            placeholder="Contraseña del usuario"
        />
    </div>
    <?php endif; ?>

    <div class="formulario__campo">
        <label for="estatus" class="formulario__label">Estatus:</label>
        <select name="estatus" id="estatus" class="formulario__select">
            <option value="" <?php echo $usuarios->estatus == '' ? 'selected' : ''; ?>>Seleccione una opción</option>
            <option value="1" <?php echo $usuarios->estatus == '1' ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo $usuarios->estatus == '0' ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="rol" class="formulario__label">Tipo de usuario:</label>
        <select name="IDrol" id="rol" class="formulario__select">
            <option value="" <?php echo $usuarios->IDrol == '' ? 'selected' : ''; ?>>Seleccione una opción</option>
            <option value="1" <?php echo $usuarios->IDrol == '1' ? 'selected' : ''; ?>>Administrador</option>
            <option value="2" <?php echo $usuarios->IDrol == '2' ? 'selected' : ''; ?>>Empleado</option>
            <option value="3" <?php echo $usuarios->IDrol == '3' ? 'selected' : ''; ?>>Cliente</option>
        </select>
    </div>
</fieldset>
