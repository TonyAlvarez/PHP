<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

//Si se accede a la página de login o registro y ya se ha iniciado sesión, redireccionar a home
if ((basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "registro.php")) {

    if (isset($_SESSION['login']) && $_SESSION['login'])
        header('Location: index.php');
} //Si se accede a la pagina de cerrar sesión o modificar perfil, y no hay ninguna sesión iniciada, redireccionar a home
else if (basename($_SERVER['PHP_SELF']) == "salir.php" || basename($_SERVER['PHP_SELF']) == "perfil.php") {

    if (!isset($_SESSION['login']) || !$_SESSION['login'])
        header('Location: index.php');
}

?>