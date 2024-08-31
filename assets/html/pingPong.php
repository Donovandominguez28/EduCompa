<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduCompa</title>

  <!-- 
    - favicon
  -->
  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">    

  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }
    article {
      text-align: center;
    }
    .btnP {
      display: inline-block;
      padding: 15px 30px;
      margin: 10px;
      font-size: 18px;
      color: #fff;
      background-color: #007BFF;
      text-decoration: none;
      margin-top:200px;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.3s;
    }
    .btnP:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }
  </style>
  
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <?php include '../html/navBar.php'; ?>

  <article>
    <a class="btnP" href="../html/pong1.php">Modo Solitario</a>
    <a class="btnP" href="../html/pong2.php">1 VS 1</a>
  </article>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to topx" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>

  <!-- 
    - custom js link
  -->
  <script src="../js/script.js" defer></script>

  <br>
  <br>
  <br>
  <?php include '../html/footer.php'; ?>
  <?php include '../html/changesMode.php'; ?>
          
  <!-- 
    - ionicon link
  -->

</body>

</html>
