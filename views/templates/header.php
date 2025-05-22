<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if (is_auth()) { ?>
                <?php if (is_admin() || $_SESSION['IDrol'] == 2) { // Mostrar "Administrar" si es administrador o empleado ?>
                    <a href="/admin/dashboard" class="header__enlace">Administrar</a>
                <?php } ?>
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Cerrar Sesion" class="header__enlace">   
                </form>
            <?php } else { ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesion</a>
            <?php } ?>
        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    La Floristería
                </h1>
            </a>

            <p class="header__texto">Flores que sanan el corazón</p>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <div class="barra__logo"></div>
        </a>
        <nav class="navegacion">
            <a href="/nosotros" class="navegacion__enlace <?php echo pagina_actual('/nosotros') ? 'navegacion__enlace--actual' : ' '; ?>">Nosotros</a>
            <a href="/productos" class="navegacion__enlace <?php echo pagina_actual('/productos') ? 'navegacion__enlace--actual' : ' '; ?>">Productos</a>
            <a href="/contacto" class="navegacion__enlace <?php echo pagina_actual('/contacto') ? 'navegacion__enlace--actual' : ' '; ?>">Contacto</a>
            <a href="/Cpedidos" class="navegacion__enlace <?php echo pagina_actual('/pedidos') ? 'navegacion__enlace--actual' : ' '; ?>">Pedidos</a>
        </nav>
    </div>
</div>