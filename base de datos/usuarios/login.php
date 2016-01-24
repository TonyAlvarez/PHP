<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'funciones.php';

if (isset($_SESSION['login']) && $_SESSION['login']) {
    //Si ya se ha iniciado sesion, se redirecciona a HOME.
    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<?php


setMenu();

$login_correcto = false;

$error_usuario_no_existe = false;
$error_pass_incorrecto = false;
$error_captcha_incorrecto = false;


//Si ya se ha enviado el formulario, coger el número de intentos del hidden, en caso contrario es el primer intento.
$intentos = (isset($_POST['enviar'])) ? $_POST['intentos'] : 0;

if (isset($_POST['enviar'])) {

    //Comrpobar que el usuario ha introducido datos en los inputs
    if (!empty($_POST['nick']) && !empty($_POST['pass'])) {

        /**
         * Aumentar el contador de intentos de inicio de sesión
         * Solo se aumenta si el usuario introduce datos en ambos INPUTs
         */
        $intentos = $_POST['intentos'] + 1;

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];


        /**
         * Conectar con la base de datos,
         * de nuevo solo se conecta con la base de datos si
         */
        include_once "Conexion.php";

        $con = new Conexion();
        $con->conectar();

        $result = $con->ejecutar_consulta("SELECT * FROM `usuarios` WHERE `nick` LIKE '" . $nick . "'");

        //Comprobar el usuario
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $pass_hash = $row['password'];

            //Comprobar la contraseña
            if (password_verify($pass, $pass_hash)) {

                //Comprobar el captcha
                if ($intentos < 3 || !empty($_POST['captcha']) && $_SESSION['captcha']['code'] == $_POST['captcha']) {
                    $pass_hash = $row['password'];

                    $_SESSION["login"] = true;

                    $_SESSION["user"] = array();
                    $_SESSION["user"]["nick"] = $nick;
                    $_SESSION["user"]["password"] = $pass_hash;
                    $_SESSION["user"]["id"] = $row['id'];
                    $_SESSION["user"]["nombre"] = $row['nombre'];
                    $_SESSION["user"]["email"] = $row['email'];
                    $_SESSION["user"]["firma"] = $row['firma'];
                    $_SESSION["user"]["avatar"] = $row['avatar'];
                    $_SESSION["user"]["tipo"] = $row['tipo'];

                    //Guardamos la hora de login ya formateada y en español.
                    setlocale(LC_TIME, "es_ES");
                    $_SESSION["user"]["hora"] = ucfirst(strftime("%A, %d de %B del %Y - %H:%M:%S"));

                    header('Location: index.php');
                } else {
                    $error_captcha_incorrecto = true;
                }
            } else {
                $error_pass_incorrecto = true;
            }
        } else {
            //El usuario no existe, avisar al usuario.
            $error_usuario_no_existe = true;
        }
    }
}

?>

<h1>Acceder como usuario registrado.</h1>

<div id="contenedor-form">

    <form method="POST">
        <label for="nick">Nombre de usuario: </label>
        <input type="text" name="nick"
               id="nick" <?php if (isset($_POST['enviar'])) echo "value='" . $_POST['nick'] . "'"; ?>/>

        <?php

        if (isset($_POST['enviar'])) {
            if (empty($_POST["nick"])) {
                echo "<span style='color:red'>No has introducido ningún nombre de usuario</span>";
            } else if ($error_usuario_no_existe) {
                echo "<span style='color:red'>El nombre de usuario no existe</span>";
            }
        }
        ?>

        <label for="pass">Contraseña: </label>
        <input type="password" name="pass" id="pass"/>

        <?php
        if (isset($_POST['enviar'])) {
            if (empty($_POST["pass"])) {
                echo "<span style='color:red'>No has introducido ninguna contraseña</span>";
            } else if ($error_pass_incorrecto) {
                echo "<span style='color:red'>La contraseña es incorrecta</span>";
                $error_requisitos = false;
            }
        }

        echo "<input type='hidden' name='intentos' value='$intentos'/>";

        /**
         * Si se pasa el límite de intentos, mostramos el captcha
         *
         * Captcha sacado de GitHub, licencia libre MIT:
         *
         * https://github.com/claviska/simple-php-captcha
         *
         */
        if ($intentos >= 3) {

            include_once "captcha/simple-php-captcha.php";
            $_SESSION['captcha'] = simple_php_captcha();

            echo "<img class='avatar' src='" . $_SESSION['captcha']['image_src'] . "' alt='CAPTCHA code'>";

            ?>

            <label for="captcha">Introduce el texto de la imagen:</label>
            <input type="text" name="captcha" id="captcha"/>

            <?php

            if (empty($_POST["captcha"])) {
                echo "<span style='color:red'>Este campo es obligatorio</span>";
            } else if ($error_captcha_incorrecto) {
                echo "<span style='color:red'>El texto no coincide, prueba de nuevo</span>";
                $error_requisitos = false;
            }
        }

        ?>


        <input type="submit" value="Entrar" name="enviar">
    </form>

</div>

</body>
</html>