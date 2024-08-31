// Arreglo que contiene las palabras para jugar
let arrayPalabras = [
    "GUITARRA", "ELEFANTE", "TURQUESA", "MARIELA", "TECLADO", "INGLATERRA",
    "COMPUTADORA", "PROGRAMACION", "JAVASCRIPT", "MATEMATICAS", "BIOLOGIA",
    "FISICA", "QUIMICA", "LITERATURA", "HISTORIA", "GEOGRAFIA", "FILOSOFIA",
    "ARTE", "MUSICA", "DEPORTES", "FUTBOL", "TENIS", "BALONCESTO", "NATACION",
    "CINE", "TEATRO", "TELEVISOR", "INTERNET", "RELOJ", "AVION"
];

// Arreglo que contiene las ayudas de cada palabra
let ayudas = [
    "Instrumento Musical", "Animal de la selva", "Es un color", "Nombre de mujer",
    "Hardware de computadora", "Es un Pais", "Dispositivo Electrónico", "Actividad Técnica",
    "Lenguaje de Programación", "Ciencia Exacta", "Ciencia de la Vida", "Ciencia Natural",
    "Ciencia de Sustancias", "Estudio de Libros", "Estudio del Pasado", "Estudio de la Tierra",
    "Estudio del Pensamiento", "Expresión Creativa", "Arte Sonoro", "Actividad Física",
    "Deporte de Pelota", "Deporte con Raqueta", "Deporte de Cancha", "Deporte Acuático",
    "Producción Audiovisual", "Espectáculo en Vivo", "Aparato Electrónico", "Red de Redes",
    "Dispositivo de Tiempo", "Medio de Transporte"
];

// Variable que guarda la cantidad de palabras ya jugadas
let cantPalabrasJugadas = 0;

// Variable que guarda la cantidad de intentos restantes
let intentosRestantes = 5;

// Variable que guarda el índice de la Palabra actual
let posActual;

// Arreglo que contiene la palabra actual con la que estoy jugando
let arrayPalabraActual = [];

// Cantidad de letras acertadas por cada jugada
let cantidadAcertadas = 0;

// Arreglo que guarda cada letra en divs
let divsPalabraActual = [];

// Cantidad de palabras que debe acertar en cada jugada
let totalQueDebeAcertar;

// Función que carga la palabra nueva para jugar
function cargarNuevaPalabra() {
    // Aumento en uno cantidad de palabras jugadas y controlo si llegó a su límite
    cantPalabrasJugadas++;
    if (cantPalabrasJugadas > arrayPalabras.length) {
        // Volvemos a cargar el arreglo
        arrayPalabras = [
            "GUITARRA", "ELEFANTE", "TURQUESA", "MARIELA", "TECLADO", "INGLATERRA",
            "COMPUTADORA", "PROGRAMACION", "JAVASCRIPT", "MATEMATICAS", "BIOLOGIA",
            "FISICA", "QUIMICA", "LITERATURA", "HISTORIA", "GEOGRAFIA", "FILOSOFIA",
            "ARTE", "MUSICA", "DEPORTES", "FUTBOL", "TENIS", "BALONCESTO", "NATACION",
            "CINE", "TEATRO", "TELEVISOR", "INTERNET", "RELOJ", "AVION"
        ];
        ayudas = [
            "Instrumento Musical", "Animal de la selva", "Es un color", "Nombre de mujer",
            "Hardware de computadora", "Es un Pais", "Dispositivo Electrónico", "Actividad Técnica",
            "Lenguaje de Programación", "Ciencia Exacta", "Ciencia de la Vida", "Ciencia Natural",
            "Ciencia de Sustancias", "Estudio de Libros", "Estudio del Pasado", "Estudio de la Tierra",
            "Estudio del Pensamiento", "Expresión Creativa", "Arte Sonoro", "Actividad Física",
            "Deporte de Pelota", "Deporte con Raqueta", "Deporte de Cancha", "Deporte Acuático",
            "Producción Audiovisual", "Espectáculo en Vivo", "Aparato Electrónico", "Red de Redes",
            "Dispositivo de Tiempo", "Medio de Transporte"
        ];
        cantPalabrasJugadas = 1;
    }

    // Selecciono una posición random
    posActual = Math.floor(Math.random() * arrayPalabras.length);

    // Tomamos la palabra nueva
    let palabra = arrayPalabras[posActual];
    // Cantidad de letras que tiene esa palabra
    totalQueDebeAcertar = palabra.length;
    // Coloco en 0 la cantidad acertadas hasta el momento
    cantidadAcertadas = 0;

    // Guardamos la palabra que está en formato string en un arreglo
    arrayPalabraActual = palabra.split('');

    // Limpiamos los contenedores que quedaron cargados con la palabra anterior
    document.getElementById("palabra").innerHTML = "";
    document.getElementById("letrasIngresadas").innerHTML = "";

    // Cargamos la cantidad de divs (letras) que tiene la palabra
    for (let i = 0; i < palabra.length; i++) {
        var divLetra = document.createElement("div");
        divLetra.className = "letra";
        document.getElementById("palabra").appendChild(divLetra);
    }

    // Selecciono todos los divs de la palabra
    divsPalabraActual = document.getElementsByClassName("letra");

    // Seteamos los intentos
    intentosRestantes = 5;
    document.getElementById("intentos").innerHTML = intentosRestantes;

    // Cargamos la ayuda de la pregunta
    document.getElementById("ayuda").innerHTML = ayudas[posActual];

    // Elimino el elemento ya seleccionado del arreglo
    arrayPalabras.splice(posActual, 1);
    ayudas.splice(posActual, 1);
}

// Llamada para cargar la primera palabra del juego
cargarNuevaPalabra();

// Detecto la tecla que el usuario presiona
document.addEventListener("keydown", event => {
    manejarIngresoLetra(event.key.toUpperCase());
});

// Función que maneja la letra ingresada
function manejarIngresoLetra(letra) {
    if (isLetter(letra) && intentosRestantes > 0) {
        // Verifica si la letra ya fue ingresada
        if (!document.getElementById("letrasIngresadas").innerHTML.includes(letra)) {
            let acerto = false;
            for (let i = 0; i < arrayPalabraActual.length; i++) {
                if (arrayPalabraActual[i] == letra) { // acertó
                    divsPalabraActual[i].innerHTML = letra;
                    acerto = true;
                    // Aumento en uno la cantidad de letras acertadas 
                    cantidadAcertadas = cantidadAcertadas + 1;
                }
            }

            // Controlo si acertó al menos una letra
            if (acerto) {
                // Controlamos si ya acertó todas
                if (totalQueDebeAcertar == cantidadAcertadas) {
                    // Asigno a cada div de la palabra la clase pintar para ponerlo en verde cada div
                    for (let i = 0; i < arrayPalabraActual.length; i++) {
                        divsPalabraActual[i].className = "letra pintar";
                    }
                    mostrarNotificacion("¡Ganaste!", "Felicidades, acertaste la palabra.", "exito");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            } else {
                // No acertó, decremento los intentos restantes
                intentosRestantes = intentosRestantes - 1;
                document.getElementById("intentos").innerHTML = intentosRestantes;

                // Controlamos si ya acabó todas las oportunidades
                if (intentosRestantes <= 0) {
                    for (let i = 0; i < arrayPalabraActual.length; i++) {
                        divsPalabraActual[i].className = "letra pintarError";
                    }
                    mostrarNotificacion("Perdiste", "Vuelve a jugar", "error");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            }

            // Agrega la letra ingresada a las letras ya ingresadas que se visualizan
            document.getElementById("letrasIngresadas").innerHTML += letra + " - ";
        }
    }
}

// Función que me determina si un carácter es una letra
function isLetter(str) {
    return str.length === 1 && str.match(/[a-z]/i);
}

// Crear botones para cada letra del alfabeto
function crearBotonesLetras() {
    let letrasDiv = document.getElementById("letras");
    for (let i = 65; i <= 90; i++) { // A-Z
        let letra = String.fromCharCode(i);
        let boton = document.createElement("div");
        boton.className = "letra-boton";
        boton.innerHTML = letra;
        boton.addEventListener("click", () => manejarIngresoLetra(letra));
        letrasDiv.appendChild(boton);
    }
}

// Llamar a la función para crear los botones al cargar la página
crearBotonesLetras();

// Función para mostrar la notificación
function mostrarNotificacion(titulo, descripcion, tipo) {
    const contenedorToast = document.getElementById('contenedor-toast');
    const toast = document.createElement('div');
    toast.className = `toast ${tipo}`;
    toast.innerHTML = `
        <div class="contenido">
            <div class="icono">
                ${tipo === 'exito' ? '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/></svg>' : 
                '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'}
            </div>
            <div class="texto">
                <p class="titulo">${titulo}</p>
                <p class="descripcion">${descripcion}</p>
            </div>
        </div>
        <button class="btn-cerrar" onclick="this.parentElement.remove()">
            <div class="icono">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
            </div>
        </button>
    `;
    contenedorToast.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 5000);
}
