<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/mis_pedidos_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Mis pedidos");

$smarty->assign("hayPedidos", count($arrayPedidos) > 0);

$smarty->assign("pedidos", $arrayPedidos);

$smarty->display('vistas/gestion-pedidos.tpl');

?>