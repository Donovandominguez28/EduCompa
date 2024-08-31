<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Sistema de Cambio de Temas</title>
    <style>
        :root {
          /* Colores originales */
          --rich-black-fogra-29: hsl(210, 26%, 7%);
          --champagne-pink: hsl(23, 61%, 86%);
          --gray-x-11-gray: hsl(0, 0%, 73%);
          --white: hsl(0, 0%, 100%);
          --black: hsl(0, 0%, 0%);
          --gainsboro: hsl(0, 0%, 87%);
          --onyx: hsl(0, 0%, 100%);
          --dark-orange: #365b77;
          --deep-saffron: #153f59;
          --light-gray: hsl(0, 0%, 95%); /* Nuevo color para la barra activa en el tema original */
        }

        /* Variables de color para los modos */
        body.light-theme {
          --background-color: var(--white);
          --text-color: var(--gray-x-11-gray);
          --navbar-bg: var(--white);
          --hover-color: var(--deep-saffron);
          --logo-color: var(--gray-x-11-gray);
        }
        
        body.dark-theme {
          --background-color: var(--rich-black-fogra-29);
          --text-color: var(--champagne-pink);
          --navbar-bg: var(--black);
          --hover-color: var(--dark-orange);
          --logo-color: var(--champagne-pink);
        }

        body.original-theme {
          --background-color: #5874d1;
          --text-color: var(--white);
          --navbar-bg: var(--dark-orange);
          --hover-color: var(--champagne-pink);
          --logo-color: var(--white);
        }

        /* Estilos generales */
        body {
          background-color: var(--background-color);
          color: black;
          transition: background-color 0.3s ease, color 0.3s ease;
          font-family: Arial, sans-serif;
        }
        
        .theme-switcher {
          position: fixed;
          top: 90px;
          right: 1px;
          z-index: 1000;
        }

        .theme-switcher select {
          padding: 10px;
          font-size: 1.2rem;
          border-radius: 5px;
          border: 1px solid var(--gray-x-11-gray);
          background-color: var(--background-color);
          color: var(--text-color);
          transition: background-color 0.3s ease, color 0.3s ease;
          display: flex;
          align-items: center;
        }

        .theme-switcher i {
          margin-right: 8px;
        }

        .header {
          background-color: transparent;
          color: var(--text-color);
          transition: background-color 0.3s ease, color 0.3s ease;
        }

        .header.active {
          background-color: var(--navbar-bg);
          color: var(--text-color);
          
        }

        .logo {
          color: var(--logo-color);
        }

       .logo:hover{
        color: var(--hover-color);
        transition: background-color 0.3s ease, color 0.3s ease;

       }
        .navbar-link {
          color: var(--text-color);
          transition: color 0.3s ease;
        }

        .navbar-link:hover, .navbar-link:focus i{
          color: var(--hover-color);
        }
    </style>

</head>
<body>
    <div class="theme-switcher">
        <select id="theme-select">
            <option value="original"><i class="bi bi-brightness-high-fill"></i> Original</option>
            <option value="light"><i class="bi bi-sun-fill"></i> Claro</option>
            <option value="dark"><i class="bi bi-moon-fill"></i> Oscuro</option>
        </select>
    </div>

    <script>
        const themeSelect = document.getElementById('theme-select');
        const body = document.body;

        // Cargar el tema guardado en localStorage si existe
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.classList.add(`${savedTheme}-theme`);
            themeSelect.value = savedTheme;
        }

        themeSelect.addEventListener('change', (e) => {
            const theme = e.target.value;

            // Eliminar las clases de tema existentes
            body.classList.remove('light-theme', 'dark-theme', 'original-theme');
            
            // Añadir la clase de tema seleccionado
            body.classList.add(`${theme}-theme`);
            
            // Guardar el tema seleccionado en localStorage
            localStorage.setItem('theme', theme);
        });
    </script>
</body>
</html>
