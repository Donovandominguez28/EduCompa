<!DOCTYPE html>
<html lang="en-US">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .translate-container {
      position: fixed;
      top: 610px;
      left: 0;
      z-index: 1000;
      font-size: 10px;
      cursor: pointer;
      transition: transform 0.3s ease-in-out;
    }

    #translate-icon {
      font-size: 30px;
      color: white;
      background-color: #007bff;
      padding: 10px;
      border-radius: 50%;
    }

    .translate-menu {
      display: none;
      margin-top: 10px;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .translate-menu.active {
      display: block;
      animation: fadeIn 0.3s ease-in-out;
    }

    .skiptranslate iframe {
      opacity: 0 !important;
    }

    img[src="https://www.google.com/images/cleardot.gif"] {
      display: none;
    }

    body {
      margin-top: 0 !important;
    }

    .goog-te-banner-frame.skiptranslate {
      display: none !important;
    }

    body {
      top: 0px !important;
    }



    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="translate-container">
    <div id="google_translate_element"></div>
  </div>
    
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      function googleTranslateElementInit() {
        new window.google.translate.TranslateElement(
          {
            autoDisplay: false,
            includedLanguages: 'en,es',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
          },
          "google_translate_element"
        );
      }

      if (!window.googleTranslateElementInit) { 
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
        document.body.appendChild(script);

        window.googleTranslateElementInit = googleTranslateElementInit;
      }
    });
  </script>
</body>
</html>
