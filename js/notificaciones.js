document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('../php/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            mostrarNotificacion('Error', data.message, 'error');
        } else {
            mostrarNotificacion('Éxito', 'Registro exitoso. ', 'exito');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error', 'Ha ocurrido un error. Inténtelo nuevamente.', 'error');
    });
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('../php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            mostrarNotificacion('Error', data.message, 'error');
        } else {
            mostrarNotificacion('Éxito', 'Inicio de sesión exitoso. Redirigiendo...', 'exito');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error', 'Ha ocurrido un error. Inténtelo nuevamente.', 'error');
    });
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function esImagenValida(archivo) {
    const tiposValidos = ['image/jpeg', 'image/png', 'image/gif'];
    return tiposValidos.includes(archivo.type);
}

function mostrarNotificacion(titulo, descripcion, tipo) {
    const contenedorToast = document.getElementById('contenedor-toast');
    const toast = document.createElement('div');
    toast.className = `toast ${tipo}`;
    toast.innerHTML = `
        <div class="contenido">
            <div class="icono">
                ${tipo === 'exito' ? '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/></svg>' : 
                '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'}
            </div>
            <div class="texto">
                <p class="titulo">${titulo}</p>
                <p class="descripcion">${descripcion}</p>
            </div>
        </div>
        <button class="btn-cerrar" onclick="this.parentElement.remove()">
            <div class="icono">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
            </div>
        </button>
    `;
    contenedorToast.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 5000);
}
