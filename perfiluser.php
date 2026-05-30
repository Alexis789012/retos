<?php
require_once("model/Usuarios.php");
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: index.html");
  exit();
}

$usuario = new Usuarios();
$datosSalud = $usuario->obtenerDatosSalud($_SESSION['nombre']);
?>

<!DOCTYPE html>
<html lang="es">

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
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

  <!-- Fin Login -->

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/user.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="css/tooplate-gymso-style.css">
</head>

<body data-spy="scroll" data-target="#navbarNav" data-offset="50">

  <!-- MENU BAR -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

      <!-- Logo con icono -->
      <a class="navbar-brand" href="index.html">
        <img src="images/logo4.png" alt="HealthBot" width="45" height="45" class="d-inline-block align-text-top">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-lg-auto">
          <li class="nav-item">
            <a href="#home" class="nav-link smoothScroll">Home</a>
          </li>

          <li class="nav-item">
            <a href="#about" class="nav-link smoothScroll">Nosotros</a>
          </li>

          <li class="nav-item">
            <a href="#class" class="nav-link smoothScroll">Beneficios</a>
          </li>

          <li class="nav-item">
            <a href="#schedule" class="nav-link smoothScroll">Testimonios</a>
          </li>

          <li class="nav-item">
            <a href="#contact" class="nav-link smoothScroll">Contact</a>
          </li>

          <li class="nav-item">
            <a href="controller/ctrlUsuario.php" class="nav-link" type="button">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- PERFIL DE USUARIO -->
  <section class="section" id="perfiluser">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-12" data-aos="fade-up" data-aos-delay="100">
          <div class="profile-card user-summary">
            <div class="profile-avatar-wrapper">
              <img src="images/Perfil.gif" alt="Avatar del Usuario" class="profile-avatar">
              <div class="edit-icon-overlay" title="Editar Perfil">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </div>
            </div>
            <h2 class="user-name"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']; ?></h2>
            <p class="user-email"><?php echo $_SESSION['correousuario']; ?></p>
            <a href="" ata-bs-toggle="modal" data-toggle="modal" data-target="#registerModal"
              data-bs-dismiss="modal">Editar Perfil</a>
            <div class="d-grid">
              <button type="button" class="btn btn-dark btn-lg mt-3" id="btnEliminarCuenta">
                Eliminar cuenta
              </button>
            </div>
            <!-- <div class="password-wrapper">
              <input type="password" id="userPassword" value="<?php echo $_SESSION['contrasena']; ?>" readonly>
              <button type="button" onclick="togglePassword()">👁</button>
            </div> -->

            <script>
              function togglePassword() {
                let passField = document.getElementById("userPassword");
                if (passField.type === "password") {
                  passField.type = "text";
                } else {
                  passField.type = "password";
                }
              }
            </script>

          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-lg-6 col-md-6 col-12 mb-4" data-aos="fade-right" data-aos-delay="200">
          <div class="info-card p-4">
            <h5 class="card-title text-center mb-4">Tus datos</h5>
            <div class="info-item mb-3">
              <div class="info-label">Edad:</div>
              <div class="info-value" id="userAge"><?php echo $_SESSION['edad']; ?></div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">Estatura:</div>
              <div class="info-value" id="userHeight">
                <?= isset($datosSalud['estatura']) ? $datosSalud['estatura'] . ' m' : 'No registrada' ?></div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">Peso:</div>
              <div class="info-value" id="userWeight">
                <?= isset($datosSalud['peso']) ? $datosSalud['peso'] . 'Kg' : 'No registrada' ?></div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">Género:</div>
              <div class="info-value" id="userGender"><?php echo $_SESSION['genero']; ?></div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-12 mb-4" data-aos="fade-left" data-aos-delay="200">
          <div class="info-card p-4">
            <h5 class="card-title text-center mb-4">Análisis</h5>
            <div class="info-item mb-3">
              <div class="info-label">IMC:</div>
              <div class="info-value" id="userIMC">
                <?= isset($datosSalud['imc']) ? $datosSalud['imc']: 'No registrada' ?></div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">TBM:</div>
              <div class="info-value" id="userTBM">1700 kcal</div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">Progreso:</div>
              <div class="info-value" id="userProgress">En seguimiento</div>
            </div>
            <div class="info-item mb-3">
              <div class="info-label">Resumen:</div>
              <div class="info-value" id="userSummary">Peso saludable</div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="plan-card p-5 text-center" data-aos="zoom-in" data-aos-delay="300">
            <h3 class="card-title">Mis planes</h3>
            <p class="mb-4">"Aquí puedes ver tus planes generados por HealthBot"</p>
            <a href="view/planesUsuario.php"><button class="btn bg-danger border-danger text-white btn-lg">Ver Mi
                Plan</button></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Editar Usuarios -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Editar Datos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="controller/ctrlUsuario.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="reg-nombre">Nombre</label>
                <input value="<?php echo $_SESSION['nombre']; ?>" type="text" class="form-control" name="nombre"
                  id="nombre" aria-describedby="helpId" required>
              </div>
              <div class="form-group col-md-6">
                <label for="reg-apellidos">Apellidos</label>
                <input value="<?php echo $_SESSION['apellidos']; ?>" type="text" class="form-control" name="apellidos"
                  id="apellidos" aria-describedby="helpId" required>
              </div>
              <div class="form-group col-md-6">
                <label for="reg-apellidos">Teléfono</label>
                <input value="<?php echo $_SESSION['telefono']; ?>" type="tel" class="form-control" name="telefono"
                  id="telefono" aria-describedby="helpId" required>
              </div>
              <div class="form-group col-md-6">
                <label for="reg-apellidos">Edad</label>
                <input value="<?php echo $_SESSION['edad']; ?>" type="tetx" class="form-control" name="edad" id="edad"
                  aria-describedby="helpId" required>
              </div>

              <div class="form-group col-md-6">
                <label for="reg-genero">Género</label>
                <select class="form-control" name="genero" id="genero" style="width: 466px;" required>
                  <option value="<?php echo $_SESSION['genero']; ?>" disabled selected>
                    <?php echo $_SESSION['genero']; ?>
                  </option>
                  <option value="Hombre">Hombre</option>
                  <option value="Mujer">Mujer</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="reg-correo">Correo Electrónico</label>
              <input type="hidden" name="correo_actual" value="<?php echo $_SESSION['correousuario']; ?>">
              <input value="<?php echo $_SESSION['correousuario']; ?>" type="email" class="form-control"
                name="correousuario" id="correousuario" aria-describedby="helpId" required>
            </div>

            <!-- Campo contraseña -->
            <div class="mb-3">
              <label for="reg-contrasena" class="form-label">Contraseña</label>
              <div class="input-group">
                <input value="<?php echo $_SESSION['contrasena']; ?>" type="password" class="form-control"
                  id="reg-contrasena" placeholder="Contraseña" name="contrasena"
                  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^\s]{8,}$"
                  title="Debe tener al menos una letra minúscula, una mayúscula, un número, mínimo 8 caracteres y sin espacios"
                  required>
                <span class="input-group-text">
                  <i id="toggleRegisterPassword" class="fa-solid fa-eye" style="cursor:pointer;"></i>
                </span>
              </div>

              <!-- Reglas de validación -->
              <div id="passwordTooltip" style="display:none; font-size:14px; margin-top:5px;">
                <strong>La contraseña debe cumplir:</strong>
                <ul style="margin:5px 0 0 15px; padding:0;">
                  <li id="lower">Al menos una letra minúscula</li>
                  <li id="upper">Al menos una letra mayúscula</li>
                  <li id="number">Al menos un número</li>
                  <li id="length">Mínimo 8 caracteres</li>
                  <li id="space">Sin espacios</li>
                </ul>
              </div>
            </div>

            <input type="hidden" name="opcion" value="5" />
            <div class="mb-3">
              <button type="submit" class="custom-btn bg-color mt-3 w-100 rounded-pill" name="submit">
                Guardar Cambios
              </button>
              <a href="perfiluser.php" type="button" class="custom-btn bg-secondary mt-3 w-100 rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                Cancelar
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <footer class="site-footer">
    <div class="container">
      <div class="row">

        <div class="ml-auto col-lg-4 col-md-5">
          <p class="copyright-text">Copyright &copy; 2025 TecnoSystem</p>
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
  <!-- VENTANA CHATBOT -->
  <div id="chat-button" class="chat-button">
    <i class="fa fa-commenting" aria-hidden="true"></i>
  </div>
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
        <p>👋 ¡Hola! <?php echo $_SESSION['nombre'] ?> </p>
        <p>¡Bienvenido de nuevo! ¿Listo para empezar una nueva rutina?</p>
      </div>

      <div class="chat-options">
        <button class="chat-option-button">📝 Obten Plan nutricional</button>
        <button class="chat-option-button">🚀 Ejercicios</button>
        <button class="chat-option-button">📅 Genera una rutina</button>
        <button class="chat-option-button">💬 Consejos</button>
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

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/smoothscroll.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/chatbot.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleLogin = document.getElementById('toggleLoginPassword');
      const loginPass = document.getElementById('login-contrasena');

      toggleLogin.addEventListener('click', function () {
        const type = loginPass.getAttribute('type') === 'password' ? 'text' : 'password';
        loginPass.setAttribute('type', type);
        toggleLogin.classList.toggle('fa-eye');
        toggleLogin.classList.toggle('fa-eye-slash');
      });
    });

    //Script de registro 
    document.addEventListener('DOMContentLoaded', function () {
      const toggleRegister = document.getElementById('toggleRegisterPassword');
      const registerPass = document.getElementById('reg-contrasena');

      toggleRegister.addEventListener('click', function () {
        const type = registerPass.getAttribute('type') === 'password' ? 'text' : 'password';
        registerPass.setAttribute('type', type);
        toggleRegister.classList.toggle('fa-eye');
        toggleRegister.classList.toggle('fa-eye-slash');
      });
    });
    // <!-- Font Awesome -->


    const passwordInput = document.getElementById('reg-contrasena');
    const tooltip = document.getElementById('passwordTooltip');
    // const togglePassword = document.getElementById('toggleRegisterPassword');
    const form = document.getElementById('registroForm'); // Asegúrate que el <form> tenga este id


    // Mostrar reglas al enfocar
    passwordInput.addEventListener('focus', () => {
      tooltip.style.display = 'block';
    });

    // Ocultar reglas al perder foco
    passwordInput.addEventListener('blur', () => {
      tooltip.style.display = 'none';
    });

    // Validación en tiempo real
    passwordInput.addEventListener('input', () => {
      const val = passwordInput.value;
      document.getElementById('lower').style.color = /[a-z]/.test(val) ? 'green' : 'red';
      document.getElementById('upper').style.color = /[A-Z]/.test(val) ? 'green' : 'red';
      document.getElementById('number').style.color = /\d/.test(val) ? 'green' : 'red';
      document.getElementById('length').style.color = val.length >= 8 ? 'green' : 'red';
      document.getElementById('space').style.color = /\s/.test(val) ? 'red' : 'green';
    });

    // Validar antes de enviar
    // form.addEventListener('submit', (event) => {
    //   const val = passwordInput.value;
    //   const valid = /[a-z]/.test(val) && /[A-Z]/.test(val) && /\d/.test(val) && val.length >= 8 && !/\s/.test(val);

    //   if (!valid) {
    //     event.preventDefault();
    //     alert('⚠️ La contraseña no cumple con los requisitos solicitados.');
    //   }
    // });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const btnEliminar = document.getElementById("btnEliminarCuenta");

      btnEliminar.addEventListener("click", () => {
        Swal.fire({
          title: "¿Estás seguro?",
          text: "Tu cuenta será eliminada permanentemente.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {
            // Enviar petición AJAX
            fetch("controller/ctrlUsuario.php", {
              method: "POST",
              headers: { "Content-Type": "application/x-www-form-urlencoded" },
              body: "opcion=4&id=<?php echo $_SESSION['id']; ?>"
            })
              .then(response => response.text())
              .then(data => {
                // Mostrar mensaje de éxito
                Swal.fire({
                  icon: "success",
                  title: "Cuenta eliminada",
                  text: "Tu cuenta ha sido eliminada exitosamente.",
                  confirmButtonText: "Aceptar"
                }).then(() => {
                  window.location.href = "index.html"; // Redirigir al inicio
                });
              })
              .catch(error => {
                // Mostrar mensaje de error
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Hubo un problema al eliminar tu cuenta. Inténtalo de nuevo.",
                  confirmButtonText: "Aceptar"
                });
              });
          }
        });
      });
    });
  </script>



</body>

</html>