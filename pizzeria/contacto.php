<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Contacto");

$smarty->display('vistas/contacto.tpl');
