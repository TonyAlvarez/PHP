<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/carrito_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Carrito");

$smarty->assign("pedidoConfirmado", isset($_POST['confirmar']));
$smarty->assign("hayPedidos", !empty($_SESSION['user']['pedidos']));

if(!isset($_POST['confirmar']) && isset($_SESSION['user']['pedidos'])) {

    $smarty->assign("unidadesTotales", $unidadesTotales);
    $smarty->assign("precioTotal", $precioTotal);

    $smarty->assign("pedidos", $arrayPedidos);
}

$smarty->display('vistas/carrito.tpl');