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
          --hover-color: var(--black);
          --logo-color: var(--gray-x-11-gray);
        }
        
        body.dark-theme {
          --background-color: var(--rich-black-fogra-29);
          --text-color: var(--champagne-pink);
          --navbar-bg: var(--black);
          --hover-color: var(--gray-x-11-gray);
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
          color: var(--text-color);
          transition: background-color 0.3s ease, color 0.3s ease;
          font-family: Arial, sans-serif;
        }
        
        .theme-container {
          position: fixed;
          top: 100px;
          right: 20px;
          z-index: 1000;
          text-align: center;
        }

        .theme-switcher {
          margin-top: 10px;
        }

        .theme-switcher select {
          padding: 10px;
          font-size: 1.2rem;
          border-radius: 5px;
          border: 1px solid var(--gray-x-11-gray);
          background-color: var(--background-color);
          color: var(--text-color);
          transition: background-color 0.3s ease, color 0.3s ease;
        }

        .theme-switcher i {
          margin-right: 8px;
        }

        .theme-label {
          font-size: 1.2rem;
          font-weight: bold;
          margin-bottom: 10px;
        }

        .header {
          background-color: transparent;
          color: var(--text-color);
        }

        .header.active {
          background-color: var(--navbar-bg);
          color: var(--text-color);
        }

        .logo {
          color: var(--logo-color);
        }

        .logo:hover {
          color: var(--hover-color);
          transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-link {
          color: var(--text-color);
          transition: color 0.3s ease;
        }

        .navbar-link:hover,
        .navbar-link:focus i {
          color: var(--hover-color);
        }

        .navbar.active {
          background-color: var(--navbar-bg);
          color: var(--text-color);
        }

        .navbar.active:hover {
          color: var(--hover-color);
          transition: background-color 0.3s ease, color 0.3s ease;
        }

        .line {
          background-color: var(--text-color);
        }
        .floating-button{
          background-color: var(--navbar-bg);
          color: var(--text-color);
        }
        
        .chatbot-toggler{
          background: var(--navbar-bg);
        }
        .chatbot-toggler{
          color: var(--text-color);
        }
        .goog-te-gadget-simple{
          background-color: var(--navbar-bg);
          color: var(--text-color);
    }
    .VIpgJd-ZVi9od-xl07Ob-lTBxed{
      background-color: var(--background-color);
    }
    .goog-te-gadget-simple .VIpgJd-ZVi9od-xl07Ob-lTBxed span{
      color: var(--text-color);
    }
    .VIpgJd-ZVi9od-vH1Gmf{
      background-color: var(--navbar-bg);
      color: var(--text-color);
    }

    .chatbot header{
      background-color: var(--hover-color);
      color: var(--navbar-bg);
    }
    .chatbox .incoming i{
      background-color: var(--hover-color);
      color: var(--navbar-bg);
    }
    .chatbox .chat p{
      background-color: var(--hover-color);
      color: var(--navbar-bg);
    }
    .chatbot{
      background-color: var(--navbar-bg);
    }
    .chatbot .chat-input{
      background-color: var(--hover-color);
      color: var(--navbar-bg);
    }
    .chat-input textarea{
      color: var(--navbar-bg);
    }
    .chat-input i{
      color: var(--navbar-bg);
    }
    .chatbox .incoming p{
      background-color: var(--hover-color);
      color: var(--navbar-bg);
    }
    .content .title{
      color: var(--text-color);
      text-shadow: 3px 4px 4px var(--navbar-bg);

    }
    .content .des{
    color: var(--text-color);
    text-shadow: 3px 4px 4px var(--navbar-bg);

}
.content .btnC button:nth-child(1){
  color: var(--text-color);
  text-shadow: 3px 4px 4px var(--navbar-bg);

}

.content .btnC button:nth-child(2){
    color: var(--text-color);
    text-shadow: 3px 4px 4px var(--navbar-bg);

}

.content .btnC button:nth-child(2):hover{
    background-color: var(--navbar-bg);
    color: var(--text-color);
    border-color: var(--hover-color);
}
.content .btnC button:nth-child(1):hover{
  background-color: var(--navbar-bg);
  color: var(--text-color);
  border-color: var(--hover-color);
}
.arrows button{
  background-color: var(--navbar-bg);
  color: var(--text-color);
}

.arrows button:hover{
    background: var(--hover-color);
    color: var(--navbar-bg);
}
    </style>
</head>
<body>
    <div class="theme-container">
        <div class="theme-label">Seleccione un modo:</div>
        <div class="theme-switcher">
            <select id="theme-select">
                <option value="original"><i class="bi bi-brightness-high-fill"></i> Predeterminado</option>
                <option value="light"><i class="bi bi-sun-fill"></i> Día</option>
                <option value="dark"><i class="bi bi-moon-fill"></i> Noche</option>
            </select>
        </div>
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
