<?php

include('../model/Usuarios.php');
$usu = new Usuarios();
$usu->conectarBd();
switch ($_REQUEST["opcion"]) {
    case '1':
        $usu->inicializar(
            null,
            $_REQUEST['nombre'],
            $_REQUEST['apellidos'],
            $_REQUEST['telefono'],
            $_REQUEST['edad'],
            $_REQUEST['genero'],
            $_REQUEST['correousuario'],
            $_REQUEST['contrasena']
        );
        $usu->registrarUsuario();
        break;

    case '2':
        $usu->consultarUsuarios($_REQUEST['correousuario']);
        break;

    case '3':
        $usu->listaUsuarios();
        break;

    case '4':
        $usu->eliminarUsuario($_REQUEST['id']);
        break;

    case '5':
        $usu->inicializar(
            null,
            $_REQUEST['nombre'],
            $_REQUEST['apellidos'],
            $_REQUEST['telefono'],
            $_REQUEST['edad'],
            $_REQUEST['genero'],
            $_REQUEST['correousuario'],
            $_REQUEST['contrasena']
        );
        $usu->modificarUsuario($_REQUEST['correo_actual']);
        break;

    case '6':
        $usu->actualizarAlumno(
            $_REQUEST['id'],
            $_REQUEST['nombrenuevo'],
            $_REQUEST['apellidosnuevos'],
            $_REQUEST['numeronuevo'],
            $_REQUEST['numeroviejo'],
            $_REQUEST['correo_enuevo']
        );
        break;

    case '7':
        $correousuario = $_REQUEST['correo'];
        $contrasena = $_REQUEST['contrasena'];
        $usu->iniciarSesion($correousuario, $contrasena);
        break;

    default:
        session_start();
        session_destroy();
        header("Location:../index.html");
        break;
}
?>