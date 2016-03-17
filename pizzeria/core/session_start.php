<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

//Si se accede a la página de login o registro y ya se ha iniciado sesión, redireccionar a home
if ((basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "registro.php")) {

    if (isset($_SESSION['login']))
        header('Location: index.php');
} //Si el usuario no está logueado, e intenta acceder a alguna página que lo requiere, redireccionar a home
else if (basename($_SERVER['PHP_SELF']) == "salir.php"
    || basename($_SERVER['PHP_SELF']) == "perfil.php"
    || basename($_SERVER['PHP_SELF']) == "pedido.php"
    || basename($_SERVER['PHP_SELF']) == "carrito.php"
    || basename($_SERVER['PHP_SELF']) == "mis-pedidos.php"
) {

    if (!isset($_SESSION['login']))
        header('Location: index.php');
}  //Si se intenta acceder a alguna página de administración, comprobar que el usuario está logueado y que es administrador
else if (basename($_SERVER['PHP_SELF']) == "gestion-ingredientes.php"
    || basename($_SERVER['PHP_SELF']) == "gestion-masas.php"
    || basename($_SERVER['PHP_SELF']) == "gestion-pedidos.php"
    || basename($_SERVER['PHP_SELF']) == "gestion-usuarios.php"
    || basename($_SERVER['PHP_SELF']) == "gestion-pizzas.php"
    || basename($_SERVER['PHP_SELF']) == "modificar-usuario.php"
    || basename($_SERVER['PHP_SELF']) == "modificar-pizza.php"
    || basename($_SERVER['PHP_SELF']) == "modificar-ingrediente.php"
    || basename($_SERVER['PHP_SELF']) == "modificar-masa.php"
    || basename($_SERVER['PHP_SELF']) == "anadir-masa.php"
    || basename($_SERVER['PHP_SELF']) == "anadir-pizza.php"
    || basename($_SERVER['PHP_SELF']) == "anadir-ingrediente.php"
) {

    if (!isset($_SESSION['login']) || !isset($_SESSION['user']) || $_SESSION['user']['tipo'] != 2)
        header('Location: index.php');
}

?>