<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__text">Bienvenido</p>

    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/login" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electronico: </label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Ingresa tu Correo"
                id="email"
                name="email"
            />
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña: </label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Ingresa tu Contraseña"
                id="password"
                name="password"
            />
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar Sesion">
    </form>
    
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes Cuenta? Obtener una!</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Contraseña?</a>
    </div>
</main>