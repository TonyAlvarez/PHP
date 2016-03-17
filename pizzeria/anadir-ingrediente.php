<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/anadir_ingrediente_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Añadir ingrediente");

$smarty->assign("issetEnviar", isset($_POST['enviar']));

if (isset($_POST['enviar'])) {
    $smarty->assign("datosCambiados", !$errorTipoImagen && !$errorPermisosImagen && !empty($_FILES['imagen']['name']) && !empty($_POST['nombre']) && !empty($_POST['descripcion']));
    $smarty->assign("errorTipoImagen", $errorTipoImagen);
    $smarty->assign("errorPermisosImagen", $errorPermisosImagen);

    $smarty->assign("imagenVacia", empty($_FILES['imagen']['name']));
    $smarty->assign("nombreVacio", empty($_POST['nombre']));
    $smarty->assign("descripcionVacia", empty($_POST['descripcion']));
}

$smarty->display('vistas/anadir-ingrediente.tpl');