const chatbotToggler = document.querySelector(".chatbot-toggler");
const closeBtn = document.querySelector(".close-btn");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input i"); // Cambiar selector a "i"

let userMessage = null; // Variable para almacenar el mensaje del usuario
const inputInitHeight = chatInput.scrollHeight;

// Configuración de la API
const API_KEY = "AIzaSyCkicgDkEB1nYllTIj6GaRC6h-spsMoULE"; // Tu clave de API aquí
const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${API_KEY}`;

const createChatLi = (message, className) => {
  // Crear un elemento <li> para el chat con el mensaje y clase dados
  const chatLi = document.createElement("li");
  chatLi.classList.add("chat", `${className}`);
  
  // Usar íconos de Bootstrap en lugar de los de Google Fonts
  let chatContent = className === "outgoing" 
    ? `<p></p>` 
    : `<i class="bi bi-robot"></i><p></p>`;
  
  chatLi.innerHTML = chatContent;
  chatLi.querySelector("p").textContent = message;
  return chatLi; // Retornar el elemento <li> del chat
}

const generateResponse = async (chatElement) => {
  const messageElement = chatElement.querySelector("p");

  // Definir las propiedades y el mensaje para la solicitud de la API
  const requestOptions = {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ 
      contents: [{ 
        role: "user", 
        parts: [{ text: userMessage }] 
      }] 
    }),
  }

  // Enviar la solicitud POST a la API, obtener la respuesta y configurar el texto de la respuesta en el párrafo
  try {
    const response = await fetch(API_URL, requestOptions);
    const data = await response.json();
    if (!response.ok) throw new Error(data.error.message);
    
    // Obtener el texto de la respuesta de la API y actualizar el elemento del mensaje
    messageElement.textContent = data.candidates[0].content.parts[0].text.replace(/\*\*(.*?)\*\*/g, '$1');
  } catch (error) {
    // Manejar el error
    messageElement.classList.add("error");
    messageElement.textContent = error.message;
  } finally {
    chatbox.scrollTo(0, chatbox.scrollHeight);
  }
}

const handleChat = () => {
  userMessage = chatInput.value.trim(); // Obtener el mensaje ingresado por el usuario y eliminar espacios adicionales
  if (!userMessage) return;

  // Limpiar el área de texto de entrada y configurar su altura a la predeterminada
  chatInput.value = "";
  chatInput.style.height = `${inputInitHeight}px`;

  // Agregar el mensaje del usuario al chatbox
  chatbox.appendChild(createChatLi(userMessage, "outgoing"));
  chatbox.scrollTo(0, chatbox.scrollHeight);

  setTimeout(() => {
    // Mostrar el mensaje "compaBot está pensando..." mientras se espera la respuesta
    const incomingChatLi = createChatLi("compaBot está pensando...", "incoming");
    chatbox.appendChild(incomingChatLi);
    chatbox.scrollTo(0, chatbox.scrollHeight);
    generateResponse(incomingChatLi);
  }, 600);
}

chatInput.addEventListener("input", () => {
  // Ajustar la altura del área de texto de entrada según su contenido
  chatInput.style.height = `${inputInitHeight}px`;
  chatInput.style.height = `${chatInput.scrollHeight}px`;
});

chatInput.addEventListener("keydown", (e) => {
  // Si se presiona la tecla Enter sin Shift y el ancho de la ventana es mayor a 800px, manejar el chat
  if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
    e.preventDefault();
    handleChat();
  }
});

sendChatBtn.addEventListener("click", handleChat);
closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
