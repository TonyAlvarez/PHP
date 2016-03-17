<?php

require_once "modelo/gestionUsuarios.php";
require_once "modelo/clases/Usuario.php";

//Si no se viene desde la página de gestión de usuarios, o no se está enviando el formulario de modificacion, redireccionar a gestión de usuarios
if (!isset($_POST['editar']) && !isset($_POST['enviar']) && !isset($_POST['restablecerAvatar']))
    header('Location: gestion-usuarios.php');

$error_email = false;
$error_pass_req = false;
$error_pass_repeat = false;

if (isset($_POST['editar']) || isset($_POST['enviar']) || isset($_POST['restablecerAvatar'])) {
    //Sacar los datos de los usuarios de la BD
    $result = getUsuario($_POST['login']);

    //Crear instancias de Usuario para el usuario a modificar a partir de los datos de la BD
    $datosUsuario = $result->fetch_assoc();

    $usuario = new Usuario();
    $usuario->setLogin($datosUsuario['login']);
    $usuario->setPass($datosUsuario['passwor']);
    $usuario->setEmail($datosUsuario['email']);
    $usuario->setNombre($datosUsuario['nombre']);
    $usuario->setFirma($datosUsuario['firma']);
    $usuario->setAvatar($datosUsuario['avatar']);
    $usuario->setTipo($datosUsuario['tipo']);
}

if (isset($_POST['restablecerAvatar'])) {
    $usuario->setAvatar('avatar_defecto.jpg');
    restablecerAvatar($_POST['login']);
} else if (isset($_POST['enviar'])) {

    //Comprobar si se quiere cambiar la contraseña, y verificar los datos introducidos
    if (!empty($_POST['pass'])) {

        $nuevo_pass = $_POST['pass'];
        $nuevo_pass_repeat = $_POST['pass_repeat'];

        //Comprobar requisitos de la nueva contraseña
        if (strlen($nuevo_pass) < 8 ||
            !preg_match("#[0-9]+#", $nuevo_pass) ||
            !preg_match("#[A-Z]+#", $nuevo_pass) ||
            !preg_match("#[a-z]+#", $nuevo_pass)
        ) {
            //La nueva contraseña no cumple los requisitos, avisar
            $error_pass_req = true;
        }

        //Si la contraseña cumple los requisitos, comprobar que coincide con el campo de repetición.
        if (!$error_pass_req && $nuevo_pass != $nuevo_pass_repeat) {
            //Las nuevas contraseñas no coinciden, avisar al usuario
            $error_pass_repeat = true;
        }
    }

    //Comprobar si se quiere cambiar el email
    if (!empty($_POST['email'])) {

        //Comprobar que el email tiene el formato correcto, en caso contrario avisar al usuario
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error_email = true;
        }
    }

    //Si no hay ningún error, se cambian los datos del usuario
    if (!$error_pass_req && !$error_pass_repeat && !$error_email) {
        if (!empty($_POST['pass'])) {
            $nuevo_pass_hash = password_hash($_POST['pass'], PASSWORD_BCRYPT, ["cost" => 8]);
            $usuario->setPass($nuevo_pass_hash);
        }

        if (!empty($_POST['email']))
            $usuario->setEmail($_POST['email']);

        if (!empty($_POST['nombre']))
            $usuario->setNombre($_POST['nombre']);

        if (!empty($_POST['firma']))
            $usuario->setFirma($_POST['firma']);

        //LLamamos a los funcion updateUsuario del modelo.
        updateUsuario($usuario);
    }

}

?>