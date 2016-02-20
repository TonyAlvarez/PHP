<?php

//Variable para saber si la validación falla en algún momento, y así evitar conectar con la base de datos
$error_requisitos = false;

$error_usuario_existe = false;

$error_pass_req = false;
$error_pass_repeat = false;
$error_email = false;

//Variable para saber si el registro se ha completado satisfactoriamente
$registro_correcto = false;

if (isset($_POST['enviar'])) {

    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $pass_repeat = $_POST['pass_repeat'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $firma = $_POST['firma'];

    //Comprobar que la contraeña tiene al menos 8 caracteres y que cumple conlos requisitos.
    if (strlen($pass) < 8) {
        $error_pass_req = true;
        $error_requisitos = true;
    } else if (!preg_match("#[0-9]+#", $pass) || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass)) {
        $error_pass_req = true;
        $error_requisitos = true;
    }

    //Comprobar que las contraseñas coinciden
    if ($pass_repeat != $pass)
        $error_requisitos = true;

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
        require_once "modelo/Conexion.php";

        $con = new Conexion();
        $con->conectar();

        $result = $con->ejecutar_consulta("SELECT * FROM `usuario` WHERE `login` LIKE '" . $login . "'");

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

            $con->ejecutar_consulta("INSERT INTO `usuario`(`login`, `password`, `nombre`, `email`, `firma`) " .
                " VALUES ('" . $login . "','" . $pass_hash . "','" . $nombre . "','" . $email . "','" . $firma . "')");

            //Si llega hasta aquí sin ningún error, ni de comprobación de datos del formulario, ni de la base de datos, es que el registro se ha completado correctamente.
            $registro_correcto = true;
        }

    }

}
?>