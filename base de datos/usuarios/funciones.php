<?php

/**
 * Pintar el menú en función de si el usuario está logueado o no.
 */
function setMenu()
{
    ?>
    <header>
        <div class="nav">
            <ul>
                <li class="inicio"><a href="index.php">Inicio</a></li>

                <?php
                if (isset($_SESSION['login']) && basename($_SERVER['PHP_SELF']) != "salir.php") {
                    ?>
                    <li class="perfil"><a href="perfil.php">Perfil</a></li>
                    <li class="salir"><a href="salir.php">Salir</a></li>
                    <?php
                } else {
                    ?>
                    <li class="login"><a href="login.php">Login</a></li>
                    <li class="registro"><a href="registro.php">Registro</a></li>
                    <?php
                }
                ?>


            </ul>
        </div>
    </header>
    <?php
}

/**
 * Eliminar todos los datos de la sesión, la cookie PHPSESSID incluida.
 *
 * Método sacado de StackOverflow:
 * http://stackoverflow.com/a/18711039/710274
 */
function destruirSesion()
{
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
}


/**
 * Redireccionar al HOME con un pequeño delay
 */
function redireccionarHome()
{

    sleep(3);

    header('Location: index.php');
}


?>