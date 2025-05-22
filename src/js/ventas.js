document.addEventListener('DOMContentLoaded', function() {
    const productosContainer = document.querySelector('.ventas-productos');
    const productosSeleccionadosContainer = document.querySelector('.ventas-productos-seleccionados');
    const totalDisplay = document.getElementById('totalDisplay');
    const buscador = document.getElementById('buscador');
    let totalVenta = 0;
    const productosEnVenta = {};

    // Almacena todos los productos en un array
    const productos = Array.from(productosContainer.children).map(producto => {
        return {
            id: producto.getAttribute('data-id'),
            precio: parseFloat(producto.getAttribute('data-precio')),
            categoria: producto.getAttribute('data-categoria'),
            elemento: producto // Guarda la referencia al elemento del DOM
        };
    });

    // Función para mostrar productos filtrados
    function mostrarProductosFiltrados(productosFiltrados) {
        productosContainer.innerHTML = ''; // Limpiar los productos existentes

        if (productosFiltrados.length === 0) {
            productosContainer.innerHTML = '<div>No se encontraron productos.</div>';
            return;
        }

        // Agregar productos filtrados al contenedor
        productosFiltrados.forEach(producto => {
            productosContainer.appendChild(producto.elemento);
        });
    }

    // Función para mostrar todos los productos
    function mostrarTodosLosProductos() {
        productosContainer.innerHTML = '';
        productos.forEach(producto => productosContainer.appendChild(producto.elemento));
    }

    // Añadir evento para el campo de búsqueda
    buscador.addEventListener('input', function() {
        const textoBusqueda = buscador.value.toLowerCase();
        const productosFiltrados = productos.filter(producto => {
            const nombreProducto = producto.elemento.querySelector('.producto-imagen').alt.toLowerCase();
            return nombreProducto.includes(textoBusqueda);
        });

        mostrarProductosFiltrados(productosFiltrados);
    });

    // Función para formatear el precio
    function formatoMoneda(valor) {
        return `$${valor.toFixed(2)}`;
    }

    // Función para actualizar el total de la venta
    function actualizarTotal() {
        totalVenta = Object.values(productosEnVenta).reduce((total, producto) => {
            return total + producto.precio * producto.cantidad;
        }, 0);
        totalDisplay.textContent = formatoMoneda(totalVenta);
    }

    // Función para actualizar la lista de productos seleccionados
    function actualizarListaProductos() {
        productosSeleccionadosContainer.innerHTML = ''; // Limpia la lista antes de actualizar
    
        Object.entries(productosEnVenta).forEach(([id, producto]) => {
            const subtotal = producto.precio * producto.cantidad;
            const productoRow = document.createElement('div');
            productoRow.classList.add('ventas-producto-row');
            
            // Crea los span con las clases correspondientes
            const spanNombre = document.createElement('span');
            spanNombre.classList.add('producto-nombre');
            spanNombre.textContent = producto.nombre;
    
            const spanCantidad = document.createElement('span');
            spanCantidad.classList.add('producto-cantidad');
            spanCantidad.textContent = producto.cantidad;
    
            const spanPrecio = document.createElement('span');
            spanPrecio.classList.add('producto-precio');
            spanPrecio.textContent = formatoMoneda(producto.precio);
    
            const spanSubtotal = document.createElement('span');
            spanSubtotal.classList.add('producto-subtotal');
            spanSubtotal.textContent = formatoMoneda(subtotal);
    
            // Agrega los spans al contenedor
            productoRow.appendChild(spanNombre);
            productoRow.appendChild(spanCantidad);
            productoRow.appendChild(spanPrecio);
            productoRow.appendChild(spanSubtotal);
    
            // Crea el botón de eliminar
            const botonEliminar = document.createElement('button');
            botonEliminar.classList.add('boton-eliminar');
            botonEliminar.setAttribute('data-id', id);
            botonEliminar.textContent = 'Eliminar';
            productoRow.appendChild(botonEliminar);
    
            // Agrega la fila al contenedor principal
            productosSeleccionadosContainer.appendChild(productoRow);
        });
    
        // Agrega eventos a los botones de eliminar
        document.querySelectorAll('.boton-eliminar').forEach(boton => {
            boton.addEventListener('click', function() {
                const productoId = this.getAttribute('data-id');
                eliminarProductoSeleccionado(productoId);
            });
        });
    }    

    function eliminarProductoSeleccionado(productoId) {
        delete productosEnVenta[productoId]; // Eliminar el producto del objeto
        actualizarListaProductos(); // Actualizar la lista visual de productos
        actualizarTotal(); // Actualizar el total de la venta
    }

    // Evento al hacer clic en cada producto
    productosContainer.addEventListener('click', function(event) {
        const card = event.target.closest('.ventas-producto');
        if (!card) return;

        const productoId = card.getAttribute('data-id');
        const nombreProducto = card.querySelector('.producto-imagen').alt;
        const precioProducto = parseFloat(card.getAttribute('data-precio'));

        if (productosEnVenta[productoId]) {
            productosEnVenta[productoId].cantidad += 1;
        } else {
            productosEnVenta[productoId] = {
                nombre: nombreProducto,
                precio: precioProducto,
                cantidad: 1
            };
        }

        actualizarListaProductos();
        actualizarTotal();
    });

    // Limpiar lista de productos
    document.querySelector('.boton-limpiar').addEventListener('click', function() {
        Object.keys(productosEnVenta).forEach(key => delete productosEnVenta[key]);
        productosSeleccionadosContainer.innerHTML = '';
        totalVenta = 0;
        totalDisplay.textContent = formatoMoneda(totalVenta);
    });

    // Evento al hacer clic en "Vender"
    document.querySelector('.boton-vender').addEventListener('click', function() {
        const clienteId = document.getElementById('cliente').value;
        if (!clienteId || Object.keys(productosEnVenta).length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Selecciona un cliente y productos para vender.',
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'mi-alerta-personalizada'
                }
            });
            return;
        }

        const ventaData = {
            clienteID: clienteId,
            productos: productosEnVenta,
            total: totalVenta
        };

        fetch('/admin/ventas/vender', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(ventaData)
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: data.mensaje,
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'mi-alerta-personalizada'
                }
            });

            Object.keys(productosEnVenta).forEach(key => delete productosEnVenta[key]);
            actualizarListaProductos();
            actualizarTotal();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + error.message,
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'mi-alerta-personalizada'
                }
            });
        });
    });

    // Evento para los botones de categoría
    const categoriaButtons = document.querySelectorAll('.ventas-categoria');
    categoriaButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-id');
            if (categoriaId === 'todos') {
                mostrarTodosLosProductos();
            } else {
                mostrarProductosPorCategoria(categoriaId);
            }
        });
    });

    // Función para mostrar productos filtrados por categoría
    function mostrarProductosPorCategoria(categoriaId) {
        productosContainer.innerHTML = '';

        const productosFiltrados = productos.filter(producto => producto.categoria == categoriaId);

        if (productosFiltrados.length === 0) {
            productosContainer.innerHTML = '<div>No hay productos en esta categoría.</div>';
            return;
        }

        productosFiltrados.forEach(producto => {
            productosContainer.appendChild(producto.elemento);
        });
    }
});
