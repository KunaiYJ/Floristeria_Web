(function() {
    const tagsInput = document.querySelector('#tags_input');

    if (tagsInput) {
        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');
        let tags = [];

        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }
        
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            if (e.key === ',') {
                if (e.target.value.trim() === '' || tags.includes(e.target.value.trim())) {
                    e.preventDefault();
                    return;
                }
                e.preventDefault();
                tags.push(e.target.value.trim());
                tagsInput.value = '';

                mostrarTags();
            }
        }

        function mostrarTags() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });

            actualizarInputHidden();
        }

        function eliminarTag(e) {
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            tagsInputHidden.value = tags.join(', ');
        }
    }
})();

function abrirModal(idProducto, cantidadFlores, stock) {
    document.getElementById("modal-inventario").style.display = "flex";
    document.getElementById("id_producto_modal").value = idProducto;
    document.getElementById("cantidad_flores").value = "";
    document.getElementById("stock").value = "";
}

function cerrarModal() {
    document.getElementById("modal-inventario").style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("modal-inventario")) {
        cerrarModal();
    }
}

