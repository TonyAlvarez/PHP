<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/modificar_masa_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Modificar masa");

$smarty->assign("issetEnviar", isset($_POST['enviar']));

if (isset($_POST['editar']) || (isset($_POST['enviar'])))
    $smarty->assign("masa", $masa);

if (isset($_POST['enviar'])) {
    $smarty->assign("datosCambiados", !$errorTipoImagen && !$errorPermisosImagen);
    $smarty->assign("errorTipoImagen", $errorTipoImagen);
    $smarty->assign("errorPermisosImagen", $errorPermisosImagen);
}

$smarty->display('vistas/modificar-masa.tpl');


?>
