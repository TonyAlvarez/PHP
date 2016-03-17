<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/modificar_usuario_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Modificar usuario");

$smarty->assign("issetEnviar", isset($_POST['enviar']));


if (isset($_POST['editar']) || (isset($_POST['enviar'])) || isset($_POST['restablecerAvatar']))
    $smarty->assign("usuario", $usuario);

if (isset($_POST['enviar'])) {

    $smarty->assign("datosCambiados", !$error_email && !$error_pass_req && !$error_pass_repeat);

    $smarty->assign("emailErrorFormato", $error_email);

    $smarty->assign("errorPassRequisitos", $error_pass_req);
    $smarty->assign("passRepeat", $error_pass_repeat);
}


$smarty->display('vistas/modificar-usuario.tpl');


?>
