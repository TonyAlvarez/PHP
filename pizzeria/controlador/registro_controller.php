<?php

require_once "modelo/gestionUsuarios.php";
require_once "modelo/clases/Usuario.php";

//Variable para saber si la validación falla en algún momento, y así evitar conectar con la base de datos
$error_requisitos = false;

$error_usuario_existe = false;

$error_pass_req = false;
$error_pass_repeat = false;
$error_email = false;

//Variable para saber si el registro se ha completado satisfactoriamente
$registro_correcto = false;

if (isset($_POST['enviar'])) {

    //Comprobar que la contraeña tiene al menos 8 caracteres y que cumple conlos requisitos.
    if (strlen($_POST['pass']) < 8) {
        $error_pass_req = true;
        $error_requisitos = true;
    } else if (!preg_match("#[0-9]+#", $_POST['pass']) || !preg_match("#[A-Z]+#", $_POST['pass']) || !preg_match("#[a-z]+#", $_POST['pass'])) {
        $error_pass_req = true;
        $error_requisitos = true;
    }

    //Comprobar que las contraseñas coinciden
    if ($_POST['pass_repeat'] != $_POST['pass'])
        $error_requisitos = true;

    /**
     * Comprobar que el email está bien formateado
     *
     * Sacado de StackOverflow:
     * http://stackoverflow.com/a/12026863/710274
     */
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_email = true;
        $error_requisitos = true;
    }

    //Si hay algún campo vacio, error de requisitos
    if (empty($_POST['login']) || empty($_POST['nombre']) || empty($_POST['firma']) || empty($_POST['terminos']))
        $error_requisitos = true;

    /**
     * Si no hay ningún error de validación, conectamos con la base de datos.
     */
    if (!$error_requisitos) {

        /**
         * Comprobar si el nombre de usuario ya exite
         */
        //Sacar los datos de los usuarios de la BD
        $result = getUsuario($_POST['login']);

        if ($result->num_rows > 0) {
            $error_usuario_existe = true;
        } else {

            //No hay ningún error, se genera un hash para la contraseña y se hace el INSERT.

            /**
             * Sacado de StackOverflow
             *
             * http://php.net/manual/es/function.password-hash.php
             */
            $pass_hash = password_hash($_POST['pass'], PASSWORD_BCRYPT, ["cost" => 8]);

            $usuario = new Usuario();
            $usuario->setLogin($_POST['login']);
            $usuario->setPass($pass_hash);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setEmail($_POST['email']);
            $usuario->setFirma($_POST['firma']);

            insertarUsuario($usuario);

            //Si llega hasta aquí sin ningún error, ni de comprobación de datos del formulario, ni de la base de datos, es que el registro se ha completado correctamente.
            $registro_correcto = true;
        }

    }

}
?>