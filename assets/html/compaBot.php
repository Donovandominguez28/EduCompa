<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Chatbot</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap Icons Link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <script src="../js/compaBot.js" defer></script>
</head>
<style>

  .chatbot-toggler {
    position: fixed;
    bottom: 15px;
    left: 10px;
    outline: none;
    border: none;
    height: 40px;
    width: 40px;
    display: flex;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    border-radius: 100%;
    transition: all 0.2s ease;
    z-index: 100000;
  }

  body.show-chatbot .chatbot-toggler {
    transform: rotate(90deg);
    background-color: red;
  }

  .chatbot-toggler i {
    position: absolute;
    font-size: 2rem;
  }

  body.show-chatbot .chatbot-toggler .bi-x {
    display: inline;
  }

  .chatbot-toggler .bi-chat {
    display: inline;
  }

  body.show-chatbot .chatbot-toggler .bi-chat {
    display: none;
  }

  .chatbot-toggler .bi-x {
    display: none;
  }

  .chatbot {
    position: fixed;
    left: 50px;
    bottom: 50px;
    width: 500px;
    border-radius: 15px;
    overflow: hidden;
    opacity: 0;
    pointer-events: none;
    transform: scale(0.5);
    transform-origin: bottom right;
    box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
      0 32px 64px -48px rgba(0, 0, 0, 0.5);
    transition: all 0.1s ease;
    z-index: 100000;
  }

  .chatbot {
    font-size: 50px;
  }

  body.show-chatbot .chatbot {
    opacity: 1;
    pointer-events: auto;
    transform: scale(1);
  }

  .chatbot header {
    padding: 16px 0;
    position: relative;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .chatbot header i {
    position: absolute;
    right: 15px;
    top: 50%;
    display: none;
    cursor: pointer;
    transform: translateY(-50%);
  }

  header h2 {
    font-size: 1.4rem;
  }

  .chatbot .chatbox {
    overflow-y: auto;
    height: 510px;
    padding: 30px 20px 100px;
  }

  .chatbot :where(.chatbox, textarea)::-webkit-scrollbar {
    width: 6px;
  }

  .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-track {
    background: #fff;
    border-radius: 25px;
  }

  .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 25px;
  }

  .chatbox .chat {
    display: flex;
    list-style: none;
  }

  .chatbox .outgoing {
    margin: 20px 0;
    justify-content: flex-end;
  }

  .chatbox .incoming i {
    width: 32px;
    height: 32px;
    cursor: default;
    text-align: center;
    line-height: 32px;
    align-self: flex-end;
    border-radius: 4px;
    margin: 0 10px 7px 0;
    font-size: 32px;
  }

  .chatbox .chat p {
    white-space: pre-wrap;
    padding: 12px 16px;
    border-radius: 10px 10px 0 10px;
    max-width: 75%;
    font-size: 1.5rem;
  }

  .chatbox .incoming p {
    border-radius: 10px 10px 10px 0;
  }

  .chatbox .chat p.error {
    color: white;
    background: red;
  }


  .chatbot .chat-input {
    display: flex;
    gap: 5px;
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 3px 20px;
    border-top: 1px solid #ddd;
  }

  .chat-input textarea {
    height: 55px;
    width: 100%;
    border: none;
    outline: none;
    resize: none;
    max-height: 180px;
    padding: 15px 15px 15px 0;
    font-size: 1.5rem;
  }

  .chat-input i {
    align-self: flex-end;
    cursor: pointer;
    height: 55px;
    display: flex;
    align-items: center;
    visibility: hidden;
    font-size: 1.5rem;
  }

  .chat-input textarea:valid~i {
    visibility: visible;
  }

  @media (max-width: 490px) {
    .chatbot-toggler {
      right: 20px;
      bottom: 20px;
    }

    .chatbot {
      right: 0;
      bottom: 0;
      height: 100%;
      border-radius: 0;
      width: 100%;
    }

    .chatbot .chatbox {
      height: 90%;
      padding: 25px 15px 100px;
    }

    .chatbot .chat-input {
      padding: 5px 15px;
    }

    .chatbot header i {
      display: block;
    }
  }
</style>

<body>
  <button class="chatbot-toggler">
    <i class="bi bi-chat"></i>
    <i class="bi bi-x"></i>
  </button>
  <div class="chatbot">
    <header>
      <h2>CompaBot</h2>
      <i class="bi bi-x close-btn"></i>
    </header>
    <ul class="chatbox">
      <li class="chat incoming">
        <i class="bi bi-robot"></i>
        <p>Holaaaa, soy CompaBot 👋<br>¿En qué puedo ayudarte?</p>
      </li>
    </ul>
    <div class="chat-input">
      <textarea placeholder="Ingrese un mensaje..." spellcheck="false" required></textarea>
      <i id="send-btn" class="bi bi-send"></i>
    </div>
  </div>
</body>

</html>
