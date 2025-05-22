document.addEventListener('DOMContentLoaded', function() {
    var calendarEl1 = document.getElementById('calendar1');
    var modal = document.getElementById('pedidoModal');
    var closeBtn = document.querySelector('.close-pedido');
    var inputBusqueda = document.getElementById('inputBusqueda');
    var calendar1;

    modal.style.display = 'none';

    if (calendarEl1) {
        calendar1 = new FullCalendar.Calendar(calendarEl1, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: '/admin/pedidos/obtener_pedidos',
            eventClick: function(info) {
                document.getElementById('modalNombreCliente').innerText = info.event.extendedProps.cliente || 'No especificado';
                document.getElementById('modalProducto').innerText = info.event.title || 'No especificado';
                document.getElementById('modalFechaEntrega').innerText = info.event.start ? info.event.start.toISOString().split('T')[0] : 'No especificada';
                document.getElementById('modalDireccion').innerText = info.event.extendedProps.direccion || 'No especificada';
                document.getElementById('modalContacto').innerText = info.event.extendedProps.contacto || 'No especificado';
                document.getElementById('pedidoId').value = info.event.id;
                document.getElementById('modalEstado').value = info.event.extendedProps.estado || 'Pendiente';
    
                // Comprobamos si es un PedidoUsuario
                if (info.event.extendedProps.tipo === 'pedidoUsuario') {
                    // Ocultar el título y el formulario de actualización de estado
                    document.querySelector('#actualizarEstadoForm').style.display = 'none';
                    document.querySelector('#actualizarEstadoTitulo').style.display = 'none'; // Asegúrate de que el título tenga este ID
                } else {
                    // Mostrar el título y el formulario de actualización de estado
                    document.querySelector('#actualizarEstadoForm').style.display = 'block';
                    document.querySelector('#actualizarEstadoTitulo').style.display = 'block'; // Mostrar el título
                }
    
                modal.style.display = 'flex';
            },
            eventClassNames: function(arg) {
                var tipo = arg.event.extendedProps.tipo; // Obtener el tipo de pedido
                if (tipo === 'pedidoUsuario') {
                    return ['pedido-usuario']; // Clase para PedidoUsuario
                }
                var estado = arg.event.extendedProps.estado;
                return estado === 'Pendiente' ? ['pendiente'] : estado === 'Pagado' ? ['pagado'] : ['terminado'];
            }            
        });

        calendar1.render();
    }

    // Filtrar eventos del calendario
    inputBusqueda.addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();

        calendar1.getEvents().forEach(function(event) {
            var title = event.title.toLowerCase();
            var cliente = event.extendedProps.cliente ? event.extendedProps.cliente.toLowerCase() : '';

            // Mostrar u ocultar eventos según el término de búsqueda
            if (title.includes(searchTerm) || cliente.includes(searchTerm)) {
                event.setProp('display', 'auto'); // Mostrar el evento
            } else {
                event.setProp('display', 'none'); // Ocultar el evento
            }
        });
    });

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        };
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    document.getElementById('actualizarEstadoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar1.refetchEvents(); // Refrescar el calendario
                modal.style.display = 'none';
            } else {
                alert('Hubo un problema al actualizar el estado');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
