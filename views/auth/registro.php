<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__text">Registrate</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre: </label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="ingresa tu nombre(s)"
                id="nombre"
                name="nombre"
                value="<?php echo $usuario->nombre ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido(s): </label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="ingresa tu apellido(s)"
                id="apellido"
                name="apellido"
                value="<?php echo $usuario->apellido ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electronico: </label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="ingresa tu Correo electronico"
                id="email"
                name="email"
                value="<?php echo $usuario->email ?>"
            />
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña: </label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="ingresa tu contraseña"
                id="password"
                name="password"
            />
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña: </label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="repetir tu contraseña"
                id="password2"
                name="password2"
            />
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>
    
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesion!</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Contraseña?</a>
    </div>
</main>