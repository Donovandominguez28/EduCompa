<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
?>
<!DOCTYPE html>
<html lang="en">

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
  <link rel="stylesheet" href="../css/chess.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">    

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <?php include '../html/navBar.php'; ?>




  
  <main>
    <article>

        <div class="chessBoard reveal">        
            <!-- Add the pawn div element -->
            <div class="square white">
              <div class="piece rook" color="black"  >
                  <img src="../images/Black-Rook.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="piece knight" color="black" >
                  <img src="../images/Black-Knight.png" alt="pawn" >
                </div>
            </div>
            <div class="square white">
              <div class="piece bishop" color="black" >
                  <img src="../images/Black-Bishop.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="piece queen" color="black" >
                  <img src="../images/Black-Queen.png" alt="pawn" >
                </div>
            </div>
            <div class="square white">
              <div class="piece king" color="black" >
                  <img src="../images/Black-King.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="piece bishop" color="black" >
                  <img src="../images/Black-Bishop.png" alt="pawn" >
                </div>
            </div>
            <div class="square white">
              <div class="piece knight" color="black">
                  <img src="../images/Black-Knight.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="coordinate rank whiteText">8</div>
      
              <div class="piece rook" color="black" >
                  <img src="../images/Black-Rook.png" alt="pawn" >
                </div>
            </div>
           <!-- ------------------------------------------------------------------------- -->
      
            <div class="square black">
              <div class="piece pawn" color="black"  >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square white">
              <div class="piece pawn" color="black" >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square black">
              <div class="piece pawn" color="black" >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square white">
              <div class="piece pawn" color="black" >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square black">
              <div class="piece pawn" color="black"  >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square white">
              <div class="piece pawn" color="black"  >
                  <img src="../images/Black-Pawn.png" alt="pawn">
                </div>
      
            </div>
            <div class="square black">
              <div class="piece pawn" color="black"  >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
            <div class="square white">
              <div class="coordinate rank blackText">7</div>
      
              <div class="piece pawn" color="black"  >
                  <img src="../images/Black-Pawn.png" alt="pawn" >
                </div>
      
            </div>
          <!-- ------------------------------------------------------------------------- -->
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black">
              <div class="coordinate rank whiteText">6</div>
      
            </div>
          <!-- ------------------------------------------------------------------------- -->
      
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white">
              <div class="coordinate rank blackText">5</div>
      
            </div>
          <!-- ------------------------------------------------------------------------- -->
      
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black">
              <div class="coordinate rank whiteText">4</div>
      
            </div>
          <!-- ------------------------------------------------------------------------- -->
      
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white"></div>
            <div class="square black"></div>
            <div class="square white">
              <div class="coordinate rank blackText">3</div>
            </div>
          <!-- ------------------------------------------------------------------------- -->
      
            <div class="square white">
              <div class="piece pawn" color="white" >
                  <img src="../images/white-pawn.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="piece pawn" color="white"  >
                  <img src="../images/white-pawn.png" alt="pawn" >
                </div>
            </div>
            <div class="square white">
              <div class="piece pawn" color="white">
                  <img src="../images/white-pawn.png" alt="pawn" >
                </div>
            </div>
            <div class="square black">
              <div class="piece pawn" color="white" >
                <img src="../images/white-pawn.png" alt="pawn" >
            </div>
            </div>
            <div class="square white">
              <div class="piece pawn" color="white" >
                <img src="../images/white-pawn.png" alt="pawn" >
            </div>
            </div>
            <div class="square black">
              <div class="piece pawn" color="white" >
                <img src="../images/white-pawn.png" alt="pawn" >
            </div>
            </div>
            <div class="square white">
              <div class="piece pawn" color="white" >
                <img src="../images/white-pawn.png" alt="pawn" >
            </div>
            </div>
            <div class="square black">
              <div class="coordinate rank whiteText">2</div>
      
              <div class="piece pawn" color="white" >
                <img src="../images/white-pawn.png" alt="pawn" >
            </div>
            </div>
          <!-- ------------------------------------------------------------------------- -->
      
            <div class="square black">
              <div class="coordinate whiteText">a</div>
      
              <div class="piece rook" color="white">
                  <img src="../images/White-Rook.png" alt="pawn" >
                 </div>
            </div>
            <div class="square white"> 
              <div class="coordinate blackText">b</div>
      
              <div class="piece knight" color="white">
                  <img src="../images/White-Knight.png" alt="knight" >
                 </div>
          </div>
            <div class="square black">
              <div class="coordinate whiteText">c</div>
      
              <div class="piece bishop" color="white">
                  <img src="../images/White-Bishop.png" alt="bishop">
                 </div>
            </div>
            <div class="square white">
              <div class="coordinate blackText">d</div>
      
              <div class="piece queen" color="white" >
                  <img src="../images/White-Queen.png" alt="queen" >
                 </div>
            </div>
            <div class="square black">
              <div class="coordinate whiteText">e</div>
      
              <div class="piece king" color="white">
                  <img src="../images/White-King.png" alt="king">
              </div>
            </div>
            <div class="square white">
              <div class="coordinate blackText">f</div>
              <div class="piece bishop" color="white" >
                  <img src="../images/White-Bishop.png" alt="bishop" >
                 </div>
            </div>
            <div class="square black">
              <div class="coordinate whiteText">g</div>
      
              <div class="piece knight" color="white" >
                  <img src="../images/White-Knight.png" alt="knight">
                 </div>
            </div>
            <div class="square white">
              <div class="coordinate rank blackText">1</div>
              <div class="coordinate blackText">h</div>     
              <div class="piece rook" color="white" >
                  <img src="../images/White-Rook.png" alt="pawn" >
                 </div>
            </div>
          </div>
    



      

    </article>
  </main>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to topx" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>

  <!-- 
    - custom js link
  -->
  <script src="../js/script.js" defer></script>
  <script src="../js/chess.js" defer></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

  <br>
  <br>
  <br>
    <?php include '../html/footer.php'; ?>

          
  <!-- 
    - ionicon link
  -->

</body>

</html>
