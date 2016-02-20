<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/salir_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Cerrar sesión");

$smarty->display('vistas/salir.tpl');

?>