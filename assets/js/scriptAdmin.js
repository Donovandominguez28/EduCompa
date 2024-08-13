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

      document.querySelectorAll('[data-bs-theme-value]').forEach(button => {
        button.addEventListener('click', () => {
          const theme = button.getAttribute('data-bs-theme-value');
          document.documentElement.setAttribute('data-bs-theme', theme);
          document.querySelectorAll('[aria-pressed]').forEach(el => el.setAttribute('aria-pressed', 'false'));
          button.setAttribute('aria-pressed', 'true');
        });
      });
      
