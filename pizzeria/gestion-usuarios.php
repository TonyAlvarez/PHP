<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/gestion_usuarios_controller.php";
require_once "core/session_manager.php";

if (isset($_POST['editar']))
    $smarty->assign("pagina", "Editar usuarios");
else
    $smarty->assign("pagina", "Gestión de usuarios");

$smarty->assign("modoEdicion", isset($_POST['editar']));

if (!isset($_POST['editar']))
    $smarty->assign("usuarios", $arrayUsuarios);

$smarty->display('vistas/gestion-usuarios.tpl');