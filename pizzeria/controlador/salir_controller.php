<?php

header("refresh:2; url=index.php");

/**
 * Eliminar todos los datos de la sesión, la cookie PHPSESSID incluida.
 *
 * Método sacado de StackOverflow:
 * http://stackoverflow.com/a/18711039/710274
 */
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

?>
