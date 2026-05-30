<!DOCTYPE html>
<html lang="es">

<head>

  <title>HealthBot</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Login -->
  <script src="https://kit.fontawesome.com/274421acc6.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="model/login.php">
  <!-- Fin Login -->

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/tooplate-gymso-style.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="css/tooplate-gymso-style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo4.png" alt="HealthBot" width="45" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item"><a href="perfiladmin.html" class="nav-link smoothScroll">Panel de Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <br><br>
        <h2 class="text-center mb-4">Gestión de Reportes</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-reportes">
                    </tbody>
            </table>
        </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/reportes.js"></script>


  <script src="js/chatbot.js"></script>

  <div id="chat-button" class="chat-button">
    <i class="fa fa-robot" aria-hidden="true"></i>
  </div>

  <!-- VENTANA CHATBOT: Prevención de Retos Virales -->
<div id="chat-container" class="chat-container">
  <div class="chat-header">
    <span class="chat-logo">
      <img src="images/bot-conversacional.png" alt="Logo del Chatbot">
    </span>
    <h3 class="chat-title">ThinkChallenge</h3>
    <div class="chat-controls">
      <span id="expand-chat" class="chat-control-btn">
        <i class="fa fa-expand" aria-hidden="true"></i>
      </span>
      <span id="close-chat" class="chat-control-btn">&times;</span>
    </div>
  </div>

  <div class="chat-body">
    <div class="welcome-message">
      <p>👋 ¡Hola! Soy <strong>ThinkChallenge</strong>, tu guía para mantenerte seguro en internet.</p>
      <p>¿Quieres saber cómo identificar o evitar retos virales peligrosos?</p>
    </div>

    <div class="chat-options">
      <button class="chat-option-button">⚠️ Reconocer riesgos</button>
      <button class="chat-option-button">💡 Qué hacer si te presionan</button>
      <button class="chat-option-button">❤️ Consejos de autocuidado</button>
    </div>

    <div id="messages-container" class="messages-container">
      <!-- Aquí aparecerán los mensajes -->
    </div>
  </div>

  <div class="chat-input-area">
    <input type="text" id="user-input" placeholder="Escribe tu duda o cuenta tu experiencia...">
    <button id="send-button">
      <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </button>
  </div>
</div>

</body>
</html>