<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/ingredientes_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Ingredientes");

$smarty->assign("ingredientes", $arrayIngredientes);

$smarty->display('vistas/ingredientes.tpl');
