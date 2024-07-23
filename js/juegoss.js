// inicializacion de variables
let tarjetasDestapadas = 0;
let tarjeta1 = null;
let tarjeta2 = null;
let primerResultado = null;
let segundoResultado = null;
let movimientos = 0;
let aciertos = 0;
let temporizador = false;
let timer = 30;
let timerinicial = 0;
let tiempoRegresivoId = null;

//apuntand a docu html
let mostrarMovimientos = document.getElementById('movimientos')
let mostrarAciertos = document.getElementById('aciertos');
let mostrarTiempo = document.getElementById('t-restante');

// Generacion de numeros aleatorios
let numeros = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8];
numeros = numeros.sort(()=>{return Math.ramdom()-0.5});
console.log(numeros);

// funciones
function contarTiempo(){
    tiempoRegresivoId = setInterval(()=>{
        timer--;
        mostrarTiempo.innerHTML = 'Tiempo: ${timer} segundos';
        if(timer == 0){
            clearInterval(tiempoRegresivoId);
            bloquearTarjetas();


        }

    },1000);
}

function bloquearTarjetas(){
    for (let i = 0; i<=15; i++){
       let tarjetaBloqueada = document.getElementById(i);
       tarjetaBloqueada.innerHTML = numeros[i];
       tarjetaBloqueada.Disabled = true;
    }
}


// Funcion principal
function destapar(id){
if(temporizador == false){
    contarTiempo();
    temporizador = true;
}


    tarjetasDestapadas++;
    console.log(tarjetasDestapadas);

    if(tarjetasDestapadas == 1){
        // Mostrar primer numero
        tarjeta1 = document.getElementById(id);
        primerResultado = numeros[id]
        tarjeta1.innerHTML = primerResultado;

        //deshabilitar primer boton
        tarjeta1.Disabled = true;
    }else if(tarjetasDestapadas ==2){
        //mostrar segundo numero
        tarjeta2 = document.getElementById(id);
        segundoResultado = numeros[id];
        tarjeta2.innerHTML = segundoResultado;

        //desahabilitar segundo boton
        tarjeta2.desabled = true;

        //incrementar movimientos
        movimientos++;
        mostrarMovimientos.innerHTML = 'movimientos: ${movimientos}';
        if(primerResultado == segundoResultado){
            // encerrar contador tarjetas destapadas
            tarjetasDestapadas = 0;

            // Aumentar aciertos
            aciertos++;
            mostrarAciertos.innerHTML = 'Aciertos: ${aciertos}';

            if(aciertos == 8){
                clearInterval(tiempoRegresivoId);
                mostrarAciertos.innerHTML = 'aciertos:${aciertos}';
                mostrarTiempo.innerHTML = 'Fantastico! ${timerinicial - timer} segundos';
                mostrarMovimientos.innerHTML = 'movimientos: ${movimientos}';
            }
        }else{
            //mostrar momentaneamente valores y volver a tapar
            setTimeout(()=>{
                tarjeta1.innerHTML = '';
                tarjeta2.innerHTML = '';
                tarjeta1.Disabled = false;
                tarjeta2.Disabled = false;
                tarjetasDestapadas = 0;
            },800);
        }
    }
}