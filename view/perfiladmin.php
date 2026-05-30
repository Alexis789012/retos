<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>HealthBott</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Login -->
  <script src="https://kit.fontawesome.com/274421acc6.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="../model/login.php">
  <!-- Fin Login -->

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link rel="stylesheet" href="../css/admin.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="../css/tooplate-gymso-style.css">
</head>

<body data-spy="scroll" data-target="#navbarNav" data-offset="50">

  <!-- MENU BAR -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

      <!-- Logo con icono -->
      <a class="navbar-brand" href="index.php">
        <img src="../images/logo4.png" alt="HealthBot" width="45" height="45" class="d-inline-block align-text-top">
      </a>
      <div class="collapse navbar-collapse" id="navbarNav"></div>
    </div>
  </nav>

  <!-- PERFIL DE ADMIN-->
  <section class="section" id="perfiladmin">
    <div class="admin-profile-container">
      <div class="profile-card user-summary">
        <div class="profile-avatar-wrapper">
          <img src="../images/Perfil.gif" alt="Avatar del Administrador" class="profile-avatar">
          <div class="edit-icon-overlay" title="Editar Perfil">
            <i class="fa fa-pencil" aria-hidden="true"></i>
          </div>
        </div>
        <h2 class="user-name">Administrador</h2>
        <p class="user-email">admin@healthbot.com</p>
        <span class="admin-badge">Super Admin</span>
      </div>

      <div class="profile-card admin-dashboard-summary">
        <h3 class="card-title">Resumen del Panel de Control</h3>
        <div class="dashboard-stats">
          <div class="stat-item">
            <span class="stat-value">125</span>
            <span class="stat-label">Usuarios Registrados</span>
          </div>
          <div class="stat-item">
            <span class="stat-value">48</span>
            <span class="stat-label">Consultas Pendientes</span>
          </div>
          <div class="stat-item">
            <span class="stat-value">3</span>
            <span class="stat-label">Chatbots Activos</span>
          </div>
          <div class="stat-item">
            <span class="stat-value">12</span>
            <span class="stat-label">Reportes Recientes</span>
          </div>
        </div>
      </div>
      <div class="profile-card quick-actions">
        <h3 class="card-title">Acciones Rápidas</h3>
        <div class="actions-grid">
          <a href="usuarios.php" class="action-button">Gestionar Usuarios</a>
          <a href="crud-consultas.html" class="action-button">Ver Consultas</a>
          <a href="reportes.html" class="action-button">Ver Reportes</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="ml-auto col-lg-4 col-md-5">
          <p class="copyright-text">Copyright &copy; 2025 TecnoSystem
          </p>
        </div>
        <div class="d-flex justify-content-center mx-auto col-lg-5 col-md-7 col-12">
          <ul class="social-icon ml-lg-3">
            <li><a href="#" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-instagram"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- SCRIPTS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/smoothscroll.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/chatbot.js"></script>

  <div id="chat-button" class="chat-button">
    <i class="fa fa-commenting" aria-hidden="true"></i>
  </div>

  <!-- VENTANA CHATBOT -->
  <div id="chat-container" class="chat-container">
    <div class="chat-header">
      <span class="chat-logo">
        <img src="images/logo.png" alt="Logo del Chatbot">
      </span>
      <h3 class="chat-title">HealthBot</h3>
      <span id="close-chat" class="close-chat">&times;</span>
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
      <input type="text" id="user-input" placeholder="Ask me anything...">
      <button id="send-button">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
      </button>
    </div>
  </div>
  </div>
</body>

</html>