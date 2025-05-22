<?php
session_start();
$usuarioLogueado = isset($_SESSION['IDusuario']) && !empty($_SESSION['IDusuario']);
?>

<h2 class="floristeria__heading"><?php echo $titulo; ?></h2>

<section class="bienvenida-seccion">
    <h2 class="bienvenida-seccion__titulo">Realiza tu pedido en minutos</h2>
    <p class="bienvenida-seccion__descripcion">¡Antes de realizar un pedido, debes iniciar sesión! ¡Gracias!</p>
    <p class="bienvenida-seccion__descripcion">Completa el formulario y estaremos encantados de atenderte.</p>

    <div class="bienvenida-seccion__proceso">
        <h3 class="bienvenida-seccion__proceso-titulo">¿Cómo funciona?</h3>
        <ol class="bienvenida-seccion__proceso-lista">
            <li class="bienvenida-seccion__proceso-item">Explora nuestros arreglos y selecciona tus favoritos.</li>
            <li class="bienvenida-seccion__proceso-item">Completa el formulario de pedido con los detalles necesarios.</li>
            <li class="bienvenida-seccion__proceso-item">Nos pondremos en contacto para confirmar la entrega y los detalles.</li>
        </ol>
    </div>
    
    <a href="#" class="boton-morado" id="hacerPedidoBtn">Hacer un Pedido</a>
</section>

<script>
    document.getElementById('hacerPedidoBtn').addEventListener('click', function(event) {
        event.preventDefault();
        
        <?php if ($usuarioLogueado): ?>
            window.location.href = '/Cpedidos/crearPedido';
        <?php else: ?>
            Swal.fire({
                icon: 'warning',
                title: 'Inicia sesión',
                text: 'Debes iniciar sesión para realizar un pedido',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = '/login';
            });
        <?php endif; ?>
    });
</script>
