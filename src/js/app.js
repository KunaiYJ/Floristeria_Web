document.addEventListener('DOMContentLoaded', function() {
    eventListener();
});

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');
    if (mobileMenu) {
        mobileMenu.addEventListener('click', navegacionResponsive);
    }

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    if (metodoContacto.length > 0) {
        metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
    }
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    
    if(e.target.value == 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Número de teléfono: </label>
            <input type="tel" placeholder="Tu número telefónico" id="telefono" name="contacto[telefono]" required>

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha: </label>
            <input type="date" id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora: </label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>
        `;
    } else {
        contactoDiv.innerHTML =  `
            <label for="email">Correo electrónico: </label>
            <input type="email" placeholder="Tu correo electrónico" id="email" name="contacto[email]" required>
        `;
    }
}
