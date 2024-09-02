<style>
    * {
        font-family: 'Roboto', sans-serif;
    }
    body {
        background-color: white;
    }

    .floating-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 100%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        z-index: 1000;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .floating-button.active {
        transform: rotate(45deg);
        background-color: red; /* Color diferente cuando está activo */
    }

    .floating-button i {
        transform: rotate(90deg);
    }

    .floating-button.active i {
        transform: rotate(-45deg); /* Rotación del ícono cuando está activo */
    }

    .hidden-content {
        display: none;
    }
</style>

<!-- Botón flotante -->
<button class="floating-button" id="floatingBtn">
    <i class="bi bi-gear-fill" id="iconoBtn"></i>
</button>
<!-- Contenedor de contenido oculto -->
<div class="hidden-content">
    <?php include '../html/translate.php'; ?>
    <?php include '../html/changesMode.php'; ?>
</div>
<script>
    const floatingBtn = document.getElementById('floatingBtn');
    const hiddenContent = document.querySelector('.hidden-content');
    const iconoBtn = document.getElementById('iconoBtn');

    floatingBtn.addEventListener('click', () => {
        // Toggle la clase 'active' en el botón
        floatingBtn.classList.toggle('active');

        // Cambiar el icono cuando el botón está activo
        if (floatingBtn.classList.contains('active')) {
            hiddenContent.style.display = 'block';
            iconoBtn.classList.remove('bi-gear-fill');
            iconoBtn.classList.add('bi-x');
        } else {
            hiddenContent.style.display = 'none';
            iconoBtn.classList.remove('bi-x');
            iconoBtn.classList.add('bi-gear-fill');
        }
    });
</script>

