<?php

$smarty->assign("logedIn", isset($_SESSION['login']) && basename($_SERVER['PHP_SELF']) != "salir.php");

if (isset($_SESSION['login']) && isset($_SESSION["user"])) {
    $smarty->assign("sessionUser", $_SESSION["user"]["login"]);
    $smarty->assign("sessionName", $_SESSION["user"]["nombre"]);
    $smarty->assign("sessionEmail", $_SESSION["user"]["email"]);
    $smarty->assign("sessionFirma", $_SESSION["user"]["firma"]);
    $smarty->assign("sessionAvatar", $_SESSION["user"]["avatar"]);
    $smarty->assign("sessionUserType", $_SESSION["user"]["tipo"]);
    $smarty->assign("horaInicioSesion", $_SESSION["user"]["hora"]);

    $smarty->assign("issetPedidos", isset($_SESSION['user']['pedidos']));

    if (isset($_SESSION['user']['pedidos']))
        $smarty->assign("numPedidosPendientes", count($_SESSION['user']['pedidos']));
}

?>