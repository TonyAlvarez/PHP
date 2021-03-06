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
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

<?php

setMenu();

$error_campo_vacio = false;
$error_requisitos = false;
$error_usuario_existe = false;

$error_pass_req = false;
$error_pass_repeat = false;
$error_email = false;

$login_correcto = false;

if (isset($_POST['enviar'])) {

    if (isset($_POST['nick']) && isset($_POST['pass']) && isset($_POST['pass_repeat']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['firma']) && isset($_POST['terminos'])) {

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        $pass_repeat = $_POST['pass_repeat'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $firma = $_POST['firma'];

        //Comprobar si algún campo está vacio
        if ($nick == null || $nombre == null || $firma == null) {
            $error_requisitos = true;
            $error_campo_vacio = true;
        }

        //Comprobar que la contraeña tiene al menos 8 caracteres y que cumple conlos requisitos.
        if (strlen($pass) < 8) {
            $error_pass_req = true;
            $error_requisitos = true;
            $msg_error_pass = "La contraseña tiene que contener al menos 8 caracteres";
        } else if (!preg_match("#[0-9]+#", $pass) || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass)) {
            $error_pass_req = true;
            $error_requisitos = true;
            $msg_error_pass = "La contraseña tiene que tener al menos una letra minúscula, una mayúscula y un número";
        }

        //Comprobar que las contraseñas coinciden
        if ($pass_repeat != $pass) {
            $error_pass_repeat = true;
            $error_requisitos = true;
        }

        /**
         * Comprobar que el email está bien formateado
         *
         * Sacado de StackOverflow:
         * http://stackoverflow.com/a/12026863/710274
         */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = true;
            $error_requisitos = true;
        }

        /**
         * Si no hay ningún error de validación, conectamos con la base de datos.
         */
        if (!$error_requisitos) {
            include_once "Conexion.php";

            $con = new Conexion();
            $con->conectar();

            $result = $con->ejecutar_consulta("SELECT * FROM `usuarios` WHERE `nick` LIKE '" . $nick . "'");

            if ($result->num_rows > 0) {
                //El usuario ya existe, avisar al usuario.
                $error_usuario_existe = true;
            } else {

                //No hay ningún error, se genera un hash para la contraseña y se hace el INSERT.

                /**
                 * Este código evaluará el servidor para determinar el coste permitido.
                 * Se establecerá el mayor coste posible sin disminuir demasiando la velocidad
                 * del servidor. 8-10 es una buena referencia, y más es bueno si los servidores
                 * son suficientemente rápidos. El código que sigue tiene como objetivo un tramo de
                 * ≤ 50 milisegundos, que es una buena referencia para sistemas con registros interactivos.
                 *
                 * http://php.net/manual/es/function.password-hash.php
                 *
                 *
                 * Porque no usar md5hash:
                 *
                 * https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
                 */
                $timeTarget = 0.05; // 50 milisegundos

                $coste = 8;
                do {
                    $coste++;
                    $inicio = microtime(true);
                    $pass_hash = password_hash($pass, PASSWORD_BCRYPT, ["cost" => $coste]);
                    $fin = microtime(true);
                } while (($fin - $inicio) < $timeTarget);

                $con->ejecutar_consulta("INSERT INTO `usuarios`(`nick`, `password`, `nombre`, `email`, `firma`, `avatar`, `tipo`) " .
                    " VALUES ('" . $nick . "','" . $pass_hash . "','" . $nombre . "','" . $email . "','" . $firma . "', 'avatar_defecto.png', 1)");

                //Si llega hasta aquí sin ningún error, ni de comprobación de datos del formulario, ni de la base de datos, es que el registro se ha completado correctamente.
                $login_correcto = true;
            }

        }

    } else {
        $error_campo_vacio = true;
    }
}

?>


<h1>Formulario de registro</h1>

<div id="contenedor-form">

    <?php

    if ($login_correcto) {
        echo "<br /><br /><br /><br /><h3>Gracias por registrarte</h3>";
    } else {

        ?>

        <form method="POST" id="registro">
            <label for="nick">Login / Nickname *</label>
            <input type="text" name="nick"
                   id="nick" <?php if (isset($_POST['enviar'])) echo "value='" . $_POST['nick'] . "'"; ?>/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["nick"] == null) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                } else if ($error_usuario_existe) {
                    echo "<span style='color:red'>El nombre de usuario ya existe</span>";
                }
            }
            ?>

            <label for="pass">Contraseña *</label>
            <input type="password" name="pass" id="pass"/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["pass"] == null && $error_campo_vacio) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                } else if ($error_pass_req) {
                    echo "<span style='color:red'>$msg_error_pass</span>";
                    $error_requisitos = false;
                }
            }
            ?>

            <label for="pass_repeat">Repita la contraseña *</label>
            <input type="password" name="pass_repeat" id="pass_repeat"/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["pass_repeat"] == null && $error_campo_vacio) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                } else if ($error_pass_repeat && $error_requisitos) {
                    echo "<span style='color:red'>Las contraseñas no coinciden</span>";
                    $error_requisitos = false;
                }
            }
            ?>

            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre"
                   id="nombre" <?php if (isset($_POST['enviar'])) echo "value='" . $_POST['nombre'] . "'"; ?>/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["nombre"] == null && $error_campo_vacio) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                }
            }
            ?>
            <label for="email">Correo electrónico *</label>
            <input type="email" name="email"
                   id="email" <?php if (isset($_POST['enviar'])) echo "value='" . $_POST['email'] . "'"; ?>/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["email"] == null && $error_campo_vacio) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                } else if ($error_email && $error_requisitos) {
                    echo "<span style='color:red'>El formato del email no es correcto</span>";
                }
            }
            ?>

            <label for="firma">Firma personal *</label>
            <input type="text" name="firma"
                   id="firma" <?php if (isset($_POST['enviar'])) echo "value='" . $_POST['firma'] . "'"; ?>/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["firma"] == null && $error_campo_vacio) {
                    echo "<span style='color:red'>Este campo no puede estar vacio</span>";
                    $error_campo_vacio = false;
                }
            }
            ?>

            <br/>

            <input type="checkbox" name="terminos" id="terminos" value="true">
            <label for="terminos">Acepto los términos y condiciones de uso</label>

            <?php
            if (isset($_POST['enviar'])) {
                if (!isset($_POST['terminos']) && $error_campo_vacio) {
                    echo "<span style='color:red'>No has aceptado los términos y condiciones</span>";
                }
            }
            ?>

            <input type="submit" value="Registrarme" name="enviar">
        </form>


        <?php
    }
    ?>
</div>

</body>
</html>