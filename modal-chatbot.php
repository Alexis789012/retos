
  <!-- VENTANA CHATBOT -->
  <div id="chat-container" class="chat-container">
    <div class="chat-header">
      <span class="chat-logo">
        <img src="images/logo.png" alt="Logo del Chatbot">
      </span>
      <h3 class="chat-title">HealthBot</h3>
      <div class="chat-controls">
        <span id="expand-chat" class="chat-control-btn">
          <i class="fa fa-expand" aria-hidden="true"></i>
        </span>
        <span id="close-chat" class="chat-control-btn">&times;</span>
      </div>
    </div>

    <div class="chat-body">
      <div class="welcome-message">
        <p>👋 ¡Hola! Soy Healthbot, tu asistente de bienestar.</p>
        <p>¿En qué puedo ayudarte hoy con tu nutrición o ejercicio?</p>
      </div>

      <div class="chat-options">
        <button class="chat-option-button">📝 Obten Plan nutricional</button>
        <button class="chat-option-button">🚀 Mejora tu salud</button>
        <button class="chat-option-button">📅 Genera una rutina</button>
        <button class="chat-option-button">💬 Salud</button>
      </div>

      <div id="messages-container" class="messages-container">
      </div>
    </div>

    <div class="chat-input-area">
      <input type="text" id="user-input" placeholder="Preguntame...">
      <button id="send-button">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
      </button>
    </div>
  </div>
  </div>