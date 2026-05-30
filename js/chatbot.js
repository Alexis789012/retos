document.addEventListener('DOMContentLoaded', () => {

  const chatButton       = document.getElementById('chat-button');
  const chatContainer    = document.getElementById('chat-container');
  const closeChat        = document.getElementById('close-chat');
  const expandChatBtn    = document.getElementById('expand-chat');
  const sendButton       = document.getElementById('send-button');
  const userInput        = document.getElementById('user-input');
  const messagesContainer = document.getElementById('messages-container');

  // ── Abrir / cerrar ──────────────────────────────
  chatButton.addEventListener('click', () => {
    const isOpen = chatContainer.style.display === 'flex';
    chatContainer.style.display = isOpen ? 'none' : 'flex';
    if (!isOpen) userInput.focus();
  });

  closeChat.addEventListener('click', () => {
    chatContainer.style.display = 'none';
  });

  // ── Expandir pantalla completa ──────────────────
  expandChatBtn.addEventListener('click', () => {
    chatContainer.classList.toggle('expanded');
    const icon = expandChatBtn.querySelector('i') || expandChatBtn;
    if (chatContainer.classList.contains('expanded')) {
      expandChatBtn.innerHTML = '<i class="fa fa-compress" aria-hidden="true"></i>';
    } else {
      expandChatBtn.innerHTML = '<i class="fa fa-expand" aria-hidden="true"></i>';
    }
  });

  // ── Enviar con botón y Enter ────────────────────
  sendButton.addEventListener('click', sendMessage);
  userInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  // ── Botones de opciones rápidas ─────────────────
  document.querySelectorAll('.chat-option-button').forEach(btn => {
    btn.addEventListener('click', () => {
      userInput.value = btn.textContent.trim();
      sendMessage();
    });
  });

  // ── SEND ────────────────────────────────────────
  function sendMessage() {
    const message = userInput.value.trim();
    if (!message) return;

    addMessage(message, 'user');
    userInput.value = '';

    // Indicador de escritura
    const typingId = showTyping();

    fetch('model/chatbot_api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message })
    })
      .then(res => res.json())
      .then(data => {
        removeTyping(typingId);
        addMessage(data.response, 'bot');
      })
      .catch(() => {
        removeTyping(typingId);
        addMessage('⚠️ Error al conectar. Por favor intenta de nuevo.', 'bot');
      });
  }

  // ── Agregar mensaje ─────────────────────────────
  function addMessage(text, sender) {
    const msg = document.createElement('div');
    msg.classList.add('message', sender);

    // Renderizar markdown básico
    msg.innerHTML = formatText(text);

    messagesContainer.appendChild(msg);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  // ── Indicador "escribiendo…" ────────────────────
  function showTyping() {
    const id = 'typing-' + Date.now();
    const div = document.createElement('div');
    div.classList.add('message', 'bot', 'typing-indicator');
    div.id = id;
    div.innerHTML = '<span></span><span></span><span></span>';
    messagesContainer.appendChild(div);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Estilos inline para los puntos animados
    div.querySelectorAll('span').forEach((s, i) => {
      Object.assign(s.style, {
        display: 'inline-block',
        width: '8px', height: '8px',
        borderRadius: '50%',
        background: '#007aff',
        margin: '0 2px',
        animation: `typingBounce 1s ${i * 0.2}s infinite ease-in-out`
      });
    });

    // Inyectar keyframe si no existe
    if (!document.getElementById('typing-style')) {
      const style = document.createElement('style');
      style.id = 'typing-style';
      style.textContent = `
        @keyframes typingBounce {
          0%, 80%, 100% { transform: scale(0.7); opacity: 0.5; }
          40% { transform: scale(1.1); opacity: 1; }
        }
      `;
      document.head.appendChild(style);
    }

    return id;
  }

  function removeTyping(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
  }

  // ── Formatear texto (markdown básico) ──────────
  function formatText(text) {
    if (!text) return '';

    // Escapar HTML para seguridad
    let safe = text
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;');

    // Negrita **texto**
    safe = safe.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');

    // Cursiva *texto*
    safe = safe.replace(/\*(.+?)\*/g, '<em>$1</em>');

    // Viñetas - item o • item
    safe = safe.replace(/^[\-•]\s+(.+)$/gm, '<li>$1</li>');
    safe = safe.replace(/(<li>[\s\S]*?<\/li>)/g, '<ul style="padding-left:18px;margin:6px 0;">$1</ul>');

    // Saltos de línea dobles = párrafo
    safe = safe.replace(/\n\n+/g, '</p><p style="margin:8px 0 0;">');
    safe = safe.replace(/\n/g, '<br>');

    return '<p style="margin:0;">' + safe + '</p>';
  }

});
