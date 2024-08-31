// Para los submenús
document.querySelectorAll('.dropdown-submenu .dropdown-toggle').forEach(function (element) {
  element.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    let submenu = this.nextElementSibling;
    if (submenu) {
      submenu.classList.toggle('show');
    }
  });
});

// Para el cambio de tema
document.querySelectorAll('[data-bs-theme-value]').forEach(button => {
  button.addEventListener('click', () => {
    const theme = button.getAttribute('data-bs-theme-value');
    document.documentElement.setAttribute('data-bs-theme', theme);
    
    // Guarda el tema seleccionado en localStorage
    localStorage.setItem('theme', theme);
    
    document.querySelectorAll('[aria-pressed]').forEach(el => el.setAttribute('aria-pressed', 'false'));
    button.setAttribute('aria-pressed', 'true');
  });
});

// Al cargar la página, aplica el tema guardado
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');
  
  // Si hay un tema guardado, aplícalo
  if (savedTheme) {
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
    
    // Actualiza el botón que corresponde al tema seleccionado
    document.querySelectorAll('[data-bs-theme-value]').forEach(button => {
      if (button.getAttribute('data-bs-theme-value') === savedTheme) {
        button.setAttribute('aria-pressed', 'true');
      } else {
        button.setAttribute('aria-pressed', 'false');
      }
    });
  }
});
