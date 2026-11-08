// Validación del formulario en el navegador (antes de enviar al servidor)

const formulario = document.getElementById('formEquipo');

formulario.addEventListener('submit', function (evento) {
    // Se quitan los espacios al inicio y al final de los campos de texto
    const camposTexto = ['nombre', 'marca', 'direccion_ip', 'ubicacion'];

    camposTexto.forEach(function (id) {
        const campo = document.getElementById(id);
        campo.value = campo.value.trim();
    });

    // Si algún campo no cumple las reglas (required, maxlength, pattern) no se envía
    if (!formulario.checkValidity()) {
        evento.preventDefault();
        evento.stopPropagation();
    }

    // Bootstrap muestra en rojo o verde cada campo
    formulario.classList.add('was-validated');
});