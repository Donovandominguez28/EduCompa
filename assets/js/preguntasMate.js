let questions = [
  {
      numb: 1,
      question: "¿Qué es un número primo?",
      answer: "Un número divisible solo por 1 y por sí mismo",
      options: [
          "Un número divisible solo por 1 y por sí mismo",
          "Un número divisible por cualquier número entero positivo",
          "Un número que tiene más de dos divisores",
          "Un número que no es divisible por ningún número entero positivo"
      ]
  },
  {
      numb: 2,
      question: "¿Qué define una función inyectiva?",
      answer: "Cada elemento del dominio se mapea a un único elemento en el codominio",
      options: [
          "Cada elemento del dominio se mapea a un único elemento en el codominio",
          "Cada elemento del codominio tiene exactamente un preimagen en el dominio",
          "Cada elemento del dominio se mapea a varios elementos en el codominio",
          "Cada elemento del codominio puede tener múltiples preimágenes"
      ]
  },
  {
      numb: 3,
      question: "¿Qué es un espacio vectorial?",
      answer: "Un conjunto de vectores con operaciones de suma y multiplicación por escalares que satisfacen ciertas propiedades",
      options: [
          "Un conjunto de vectores con operaciones de suma y multiplicación por escalares que satisfacen ciertas propiedades",
          "Un conjunto de números reales ordenados",
          "Un conjunto de puntos en un plano cartesiano",
          "Un conjunto de matrices que se pueden sumar"
      ]
  },
  {
      numb: 4,
      question: "¿Qué es un determinante de una matriz?",
      answer: "Un número que representa el área o volumen de un paralelogramo o paralelepípedo definido por los vectores de la matriz",
      options: [
          "Un número que representa el área o volumen de un paralelogramo o paralelepípedo definido por los vectores de la matriz",
          "Un número que indica el número de soluciones de un sistema de ecuaciones",
          "Un número que define el rango de una matriz",
          "Un número que representa el producto de los elementos de la matriz"
      ]
  },
  {
      numb: 5,
      question: "¿Cuál es el criterio para que un polinomio sea irreducible sobre los números racionales?",
      answer: "El polinomio no puede ser factorizado en factores de grado menor con coeficientes racionales",
      options: [
          "El polinomio no puede ser factorizado en factores de grado menor con coeficientes racionales",
          "El polinomio tiene coeficientes enteros",
          "El polinomio tiene raíces enteras",
          "El polinomio es un polinomio de grado 2"
      ]
  },
  {
      numb: 6,
      question: "¿Qué caracteriza a una serie convergente?",
      answer: "La suma de sus términos se aproxima a un número finito",
      options: [
          "La suma de sus términos se aproxima a un número finito",
          "La serie tiene un número finito de términos",
          "La suma de sus términos crece sin límite",
          "La serie tiene términos negativos"
      ]
  },
  {
      numb: 7,
      question: "¿Qué es una ecuación diferencial ordinaria (EDO)?",
      answer: "Una ecuación que relaciona una función y sus derivadas con respecto a una sola variable",
      options: [
          "Una ecuación que relaciona una función y sus derivadas con respecto a una sola variable",
          "Una ecuación que involucra múltiples variables independientes",
          "Una ecuación que relaciona una función y sus derivadas parciales",
          "Una ecuación algebraica con coeficientes variables"
      ]
  },
  {
      numb: 8,
      question: "¿Qué es el teorema fundamental del cálculo?",
      answer: "Establece que la integral definida de una función es la antiderivada evaluada en los límites",
      options: [
          "Establece que la derivada de una función es la integral de su derivada",
          "Establece que la integral definida de una función es la antiderivada evaluada en los límites",
          "Establece que todas las funciones continuas son integrables",
          "Establece que la derivada de una integral es cero"
      ]
  },
  {
      numb: 9,
      question: "¿Qué es una matriz simétrica?",
      answer: "Una matriz que es igual a su transpuesta",
      options: [
          "Una matriz que es igual a su transpuesta",
          "Una matriz que tiene la misma cantidad de filas y columnas",
          "Una matriz donde todos los elementos son iguales",
          "Una matriz que tiene elementos en la diagonal principal iguales a cero"
      ]
  },
  {
      numb: 10,
      question: "¿Qué es un número complejo?",
      answer: "Un número de la forma a+bi, donde a y b son números reales y i es la raíz cuadrada de -1",
      options: [
          "Un número de la forma a+bi, donde a y b son números reales y i es la raíz cuadrada de -1",
          "Un número que puede ser representado en la forma de una fracción",
          "Un número que puede ser expresado como una raíz cuadrada",
          "Un número que se puede representar en una forma binaria"
      ]
  },
  {
      numb: 11,
      question: "¿Qué es el álgebra lineal?",
      answer: "La rama de las matemáticas que estudia los espacios vectoriales y las transformaciones lineales entre ellos",
      options: [
          "La rama de las matemáticas que estudia los espacios vectoriales y las transformaciones lineales entre ellos",
          "La rama de las matemáticas que estudia los números enteros y sus propiedades",
          "La rama de las matemáticas que se ocupa de los polinomios y ecuaciones cuadráticas",
          "La rama de las matemáticas que estudia las series infinitas"
      ]
  },
  {
      numb: 12,
      question: "¿Qué es una función continua?",
      answer: "Una función en la que los valores se pueden dibujar sin levantar el lápiz del papel",
      options: [
          "Una función en la que los valores se pueden dibujar sin levantar el lápiz del papel",
          "Una función que tiene derivada en cada punto",
          "Una función que tiene un rango finito",
          "Una función que tiene un límite en cada punto"
      ]
  },
  {
      numb: 13,
      question: "¿Qué es una sucesión aritmética?",
      answer: "Una sucesión en la que la diferencia entre términos consecutivos es constante",
      options: [
          "Una sucesión en la que la diferencia entre términos consecutivos es constante",
          "Una sucesión en la que el cociente entre términos consecutivos es constante",
          "Una sucesión en la que los términos son sumas de términos anteriores",
          "Una sucesión en la que los términos son productos de términos anteriores"
      ]
  },
  {
      numb: 14,
      question: "¿Qué define un número irracional?",
      answer: "Un número que no puede ser expresado como una fracción exacta",
      options: [
          "Un número que no puede ser expresado como una fracción exacta",
          "Un número que tiene un número finito de decimales",
          "Un número que puede ser expresado como una fracción exacta",
          "Un número que tiene una raíz cuadrada exacta"
      ]
  },
  {
      numb: 15,
      question: "¿Qué es una integral indefinida?",
      answer: "La antiderivada de una función, más una constante de integración",
      options: [
          "La antiderivada de una función, más una constante de integración",
          "La suma de una función en un intervalo finito",
          "La derivada de una función",
          "La solución de una ecuación diferencial"
      ]
  },
  {
      numb: 16,
      question: "¿Qué es el principio de inducción matemática?",
      answer: "Un método para probar que una proposición es verdadera para todos los números naturales",
      options: [
          "Un método para probar que una proposición es verdadera para todos los números naturales",
          "Un método para resolver ecuaciones algebraicas",
          "Un método para integrar funciones complejas",
          "Un método para encontrar la inversa de una función"
      ]
  },
  {
      numb: 17,
      question: "¿Qué es una función periódica?",
      answer: "Una función que se repite en intervalos regulares",
      options: [
          "Una función que se repite en intervalos regulares",
          "Una función que tiene una derivada constante",
          "Una función que tiene un límite en cada punto",
          "Una función que es continua en todos los puntos"
      ]
  },
  {
      numb: 18,
      question: "¿Qué es un conjunto vacío?",
      answer: "Un conjunto que no contiene ningún elemento",
      options: [
          "Un conjunto que no contiene ningún elemento",
          "Un conjunto que contiene todos los números reales",
          "Un conjunto que contiene solo el número cero",
          "Un conjunto que contiene un número finito de elementos"
      ]
  },
  {
    numb: 19,
    question: "¿Qué es una matriz inversa?",
    answer: "Una matriz que, multiplicada por la matriz original, da como resultado la matriz identidad",
    options: [
        "Una matriz que tiene todos sus elementos negativos",
        "Una matriz que tiene los elementos invertidos en su diagonal",
        "Una matriz que, multiplicada por la matriz original, da como resultado la matriz identidad",
        "Una matriz que tiene ceros en su diagonal principal"
    ]
},
{
    numb: 20,
    question: "¿Qué es una función logarítmica?",
    answer: "Una función que es la inversa de una función exponencial",
    options: [
        "Una función que siempre crece de forma lineal",
        "Una función que es la inversa de una función exponencial",
        "Una función que siempre tiene una pendiente negativa",
        "Una función que se define solo para valores positivos"
    ]
}
];
