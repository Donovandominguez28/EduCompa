<!DOCTYPE html>
<html lang="en-US">
<head>
  <style>
    .header.active {
      margin-top: 40px;
    }
    .translate-container {
      position: fixed;
      top: 125px;
      right: 0px;
      z-index: 1000;
      background-color:white;
      color:black;
      font-size:10px;
    }
  </style>
</head>
<body>
  <div class="translate-container">
    <div id="google_translate_element"></div>
  </div>
    
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en', 
        includedLanguages: 'es,en'
      }, 'google_translate_element');
    }
  </script>
    
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>