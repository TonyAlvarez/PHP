<?php
require_once "modelo/gestionUsuarios.php";
require_once "modelo/clases/Usuario.php";

$error_usuario_no_existe = false;
$error_pass_incorrecto = false;

$mostrarCaptcha = false;
$error_captcha_vacio = false;
$error_captcha_incorrecto = false;

//Si ya se ha enviado el formulario, coger el número de intentos del hidden, en caso contrario es el primer intento.
$intentos = (isset($_POST['enviar'])) ? $_POST['intentos'] : 0;

if (isset($_POST['enviar'])) {

    //Comrpobar que el usuario ha introducido datos en los inputs
    if (!empty($_POST['login']) && !empty($_POST['pass'])) {

        $login = $_POST['login'];
        $password = $_POST['pass'];

        /**
         * Aumentar el contador de intentos de inicio de sesión
         * Solo se aumenta si el usuario introduce datos en ambos INPUTs
         */
        $intentos = $_POST['intentos'] + 1;
        //Si es el 3er intento o más, se muestra el captcha
        $mostrarCaptcha = ($intentos >= 3);

        /**
         * Recuperar el usuario con el login que quiere acceder
         */
        //Sacar los datos de los usuarios de la BD
        $result = getUsuario($_POST['login']);

        //Comprobar que el usuario existe
        if ($result->num_rows > 0) {

            $datosUsuario = $result->fetch_assoc();
            $pass_hash = $datosUsuario['password'];

            //Comprobar la contraseña
            if (!password_verify($password, $pass_hash)) {
                $error_pass_incorrecto = true;
            }

            //Si se muestra el captcha, comprobar que el texto coincide
            if ($mostrarCaptcha) {
                //Comprobar si el captcha está vacio
                $error_captcha_vacio = empty($_POST['captcha']);

                //Comprobar que el captcha coincide con la imagen
                if (!$error_captcha_vacio)
                    $error_captcha_incorrecto = strcmp($_SESSION['captcha']['code'], $_POST['captcha']);
            }

            if (!$error_pass_incorrecto && (!$mostrarCaptcha || !$error_captcha_vacio && !$error_captcha_incorrecto)) {
                $pass_hash = $datosUsuario['password'];

                $_SESSION["login"] = true;

                $_SESSION["user"] = array();
                $_SESSION["user"]["login"] = $login;
                $_SESSION["user"]["password"] = $pass_hash;
                $_SESSION["user"]["nombre"] = $datosUsuario['nombre'];
                $_SESSION["user"]["email"] = $datosUsuario['email'];
                $_SESSION["user"]["firma"] = $datosUsuario['firma'];
                $_SESSION["user"]["avatar"] = $datosUsuario['avatar'];
                $_SESSION["user"]["tipo"] = $datosUsuario['tipo'];

                //Guardamos la hora de login ya formateada y en español.
                setlocale(LC_TIME, "es_ES");
                $_SESSION["user"]["hora"] = ucfirst(strftime("%A, %d de %B del %Y - %H:%M:%S"));

                header('Location: index.php');
            }

            //Si es la primera vez que aparece el captcha, evitar mostrar el error por estar vacio
            if ($intentos == 3) {
                $error_captcha_vacio = false;
            }
        } else {
            //El usuario no existe, avisar al usuario.
            $error_usuario_no_existe = true;
        }
    } else {
        $error_usuario_vacio = empty($_POST['login']);
        $error_pass_vacio = empty($_POST['pass']);
    }


    /**
     * Si se pasa el límite de intentos, mostramos el captcha
     *
     * Captcha sacado de GitHub, licencia libre MIT:
     *
     * https://github.com/claviska/simple-php-captcha
     *
     */
    if ($intentos >= 3) {
        require_once "captcha/simple-php-captcha.php";
        $_SESSION['captcha'] = simple_php_captcha();
    }

}

?>