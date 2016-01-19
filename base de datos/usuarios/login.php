<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'metodos.php';

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

if (isset($_POST['enviar'])) {

    if (isset($_POST['nick']) && $_POST['nick'] != null && isset($_POST['pass']) && $_POST['pass'] != null ) {

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];

        include_once "Conexion.php";

        $con = new Conexion();
        $con->conectar();

        $result = $con->ejecutar_consulta("SELECT * FROM `usuarios` WHERE `nick` LIKE '" . $nick . "'");

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $pass_hash = $row['password'];

            if (password_verify($pass, $pass_hash)) {

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

                header('Location: index.php');
            } else {
                $error_pass_incorrecto = true;
            }
        } else {
            //El usuario no existe, avisar al usuario.
            $error_usuario_no_existe = true;
        }

    } else {

    }


}

?>

<h1>Acceder como usuario registrado.</h1>

<div id="contenedor-form">

        <form method="POST">
            <label for="nick">Nombre de usuario: </label>
            <input type="text" name="nick" id="nick"/>

            <?php
            if (isset($_POST['enviar'])) {
                if ($_POST["nick"] == null) {
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
                if ($_POST["pass"] == null) {
                    echo "<span style='color:red'>No has introducido ninguna contraseña</span>";
                } else if ($error_pass_incorrecto) {
                    echo "<span style='color:red'>La contraseña es incorrecta</span>";
                    $error_requisitos = false;
                }
            }
            ?>
            <input type="submit" value="Aceptar" name="enviar">
        </form>

</div>

</body>
</html>