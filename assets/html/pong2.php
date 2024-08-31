<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Pong - Dos Jugadores</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #000;
            overflow: hidden; /* Oculta las barras de desplazamiento */
        }
        #gameContainer {
            position: relative;
            width: 100%;
            height: 100%;
        }
        #ball {
            width: 20px;
            height: 20px;
            background: #000;
            position: absolute;
            left: 10px;
            top: 0px;
            border: 2px solid #fff;
            border-radius: 50%; /* Hace que la bola sea completamente redonda */
        }
        .bar {
            width: 20px;
            height: 100px;
            background: #000;
            border: 2px solid #fff;
            position: absolute;
        }
        #bar1 {
            left: 0;
        }
        #bar2 {
            right: 0;
        }
        #line {
            position: absolute;
            left: 50%;
            top: 0;
            width: 5px;
            border-right: #fff dashed 5px;
            height: 100%;
            transform: translateX(-50%);
        }
        #scoreBoard {
            position: absolute;
            top: 10px;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 24px;
            z-index: 1000;
        }
        #controls {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="scoreBoard">
        Jugador 1: <span id="score1">0</span> - Jugador 2: <span id="score2">0</span>
    </div>
    <div id="gameContainer">
        <div id="ball"></div>
        <div id="bar1" class="bar"></div>
        <div id="bar2" class="bar"></div>
        <div id="line"></div>
    </div>
    <div id="controls">
        <button id="pauseButton">Pausar</button>
        <button id="exitButton">Salir</button>
    </div>
</body>
<script>
var game = function(){
    let time = 50;
    let movement = 10;
    let movementBar = 20;
    let width = document.documentElement.clientWidth - movement;
    let height = document.documentElement.clientHeight - movement;
    let controlGame;
    let player1Score = 0;
    let player2Score = 0;
    let isPaused = false;
    let player1 = { keyPress: false, keyCode: null };
    let player2 = { keyPress: false, keyCode: null };

    function start(){
        init();
        controlGame = setInterval(play, time);
    }

    function init(){
        ball.style.left = "50%";
        ball.style.top = "50%";
        ball.state = 1;
        ball.direction = 1; // right 1, left 2
    }

    function stop(){
        clearInterval(controlGame);
        document.body.style.background = "#f00";
    }

    function play(){
        if (!isPaused) {
            moveBall();
            moveBars();
            checkIfLost();
        }
    }

    function checkIfLost(){
        if(ball.offsetLeft >= width){
            player1Score++;
            updateScore();
            resetGame();
            console.log("Punto para el jugador 1");
        }
        if(ball.offsetLeft <= 0){
            player2Score++;
            updateScore();
            resetGame();
            console.log("Punto para el jugador 2");
        }
    }

    function moveBall(){
        checkStateBall();
        switch(ball.state){
            case 1: // derecha, abajo
                ball.style.left = (ball.offsetLeft + movement) + "px";
                ball.style.top = (ball.offsetTop + movement) + "px";
                break;
            case 2: // derecha, arriba
                ball.style.left = (ball.offsetLeft + movement) + "px";
                ball.style.top = (ball.offsetTop - movement) + "px";
                break;
            case 3: // izquierda, abajo
                ball.style.left = (ball.offsetLeft - movement) + "px";
                ball.style.top = (ball.offsetTop + movement) + "px";
                break;
            case 4: // izquierda, arriba
                ball.style.left = (ball.offsetLeft - movement) + "px";
                ball.style.top = (ball.offsetTop - movement) + "px";
                break;
        }
    }

    function checkStateBall(){
        if(collidePlayer2()){
            ball.direction = 2;
            if(ball.state == 1) ball.state = 3;
            if(ball.state == 2) ball.state = 4;
        } else if(collidePlayer1()){
            ball.direction = 1;
            if(ball.state == 3) ball.state = 1;
            if(ball.state == 4) ball.state = 2;
        }

        if(ball.direction === 1){
            if(ball.offsetTop >= height) ball.state = 2;
            else if(ball.offsetTop <= 0) ball.state = 1;
        } else {
            if(ball.offsetTop >= height) ball.state = 4;
            else if(ball.offsetTop <= 0) ball.state = 3;
        }
    }

    function collidePlayer1(){
        if(ball.offsetLeft <= (bar1.clientWidth) &&
           ball.offsetTop >= bar1.offsetTop &&
           ball.offsetTop <= (bar1.offsetTop + bar1.clientHeight)){
            return true;
        }
        return false;
    }

    function collidePlayer2(){
        if(ball.offsetLeft >= (width - bar2.clientWidth) &&
           ball.offsetTop >= bar2.offsetTop &&
           ball.offsetTop <= (bar2.offsetTop + bar2.clientHeight)){
            return true;
        }
        return false;
    }

    function moveBars(){
        if(player1.keyPress){
            if(player1.keyCode == 81 && bar1.offsetTop >= 0) // Q
                bar1.style.top = (bar1.offsetTop - movementBar) + "px";
            if(player1.keyCode == 65 && (bar1.offsetTop + bar1.clientHeight) <= height) // A
                bar1.style.top = (bar1.offsetTop + movementBar) + "px";
        }
        if(player2.keyPress){
            if(player2.keyCode == 79 && bar2.offsetTop >= 0) // O
                bar2.style.top = (bar2.offsetTop - movementBar) + "px";
            if(player2.keyCode == 76 && (bar2.offsetTop + bar2.clientHeight) <= height) // L
                bar2.style.top = (bar2.offsetTop + movementBar) + "px";
        }
    }

    document.onkeydown = function(e){
        e = e || window.event;
        switch(e.keyCode){
            case 81: // Q
            case 65: // A
                player1.keyCode = e.keyCode;
                player1.keyPress = true;
            break;
            case 79: // O
            case 76: // L
                player2.keyCode = e.keyCode;
                player2.keyPress = true;
            break;
        }
    }

    document.onkeyup = function(e){
        if(e.keyCode == 81 || e.keyCode == 65)
            player1.keyPress = false;
        if(e.keyCode == 79 || e.keyCode == 76)
            player2.keyPress = false;
    }

    function resetGame() {
        clearInterval(controlGame);
        setTimeout(() => {
            init();
            controlGame = setInterval(play, time);
        }, 1000);
    }

    function updateScore() {
        document.getElementById("score1").textContent = player1Score;
        document.getElementById("score2").textContent = player2Score;
    }

    document.getElementById("pauseButton").onclick = function() {
        isPaused = !isPaused;
        if (isPaused) {
            clearInterval(controlGame);
            this.textContent = "Reanudar";
        } else {
            controlGame = setInterval(play, time);
            this.textContent = "Pausar";
        }
    };

    document.getElementById("exitButton").onclick = function() {
        stop();
        alert("Juego terminado");
        window.location.href = '../html/pingPong.php';
    };

    start();
}();
</script>
</body>
</html>
