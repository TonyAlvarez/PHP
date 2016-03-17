<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/pizzas_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Gestión de pizzas");

$smarty->assign("pizzas", $arrayPizzas);

$smarty->display('vistas/gestion-pizzas.tpl');