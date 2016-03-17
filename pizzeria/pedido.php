<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/pedido_controller.php";
require_once "controlador/masas_controller.php";
require_once "controlador/ingredientes_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Pedido");

$smarty->assign("issetPost", isset($_POST['enviar']));

if (!isset($_POST['enviar'])) {
    $smarty->assign("masas", $arrayMasas);
    $smarty->assign("ingredientes", $arrayIngredientes);
}

$smarty->display('vistas/pedido.tpl');

?>
