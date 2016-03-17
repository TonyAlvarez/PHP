<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/pizzas_controller.php";
require_once "controlador/masas_controller.php";
require_once "controlador/ingredientes_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Pizzas");

$smarty->assign("issetPost", isset($_POST['enviar']));

if (!isset($_POST['enviar'])) {
    $smarty->assign("pizzas", $arrayPizzas);
    $smarty->assign("masas", $arrayMasas);
    $smarty->assign("ingredientes", $arrayIngredientes);
}

$smarty->display('vistas/pizzas.tpl');
