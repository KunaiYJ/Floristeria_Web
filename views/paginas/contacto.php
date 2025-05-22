<main class="contenedor seccion">
    <h1>Contáctanos</h1>

    <?php if($mensaje) { ?>
            <p class='alerta__exito'><?php echo $mensaje; ?></p>
    <?php } ?>

    <picture>
        <source srcset="build/img/fondo-formulario.webp" type="image/webp">
        <source srcset="build/img/fondo-formulario.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/fondo-formulario.jpeg" alt="form-contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulariocontacto" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre: </label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje: </label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>¿Como desea ser Contactado?</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>



        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde enviar">

    </form>
</main>