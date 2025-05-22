document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBusqueda');
    const filas = document.querySelectorAll('.table__tbody .table__tr');

    inputBusqueda.addEventListener('input', function() {
        const filtro = inputBusqueda.value.toLowerCase();

        filas.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = '';  // Muestra la fila
            } else {
                fila.style.display = 'none';  // Oculta la fila
            }
        });
    });
});
