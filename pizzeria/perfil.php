<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/perfil_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Perfil");

$smarty->assign("errorTamanoAvatar", $error_avatar_size);
$smarty->assign("errorTipoAvatar", $error_avatar_type);
$smarty->assign("errorPermisosAvatar", $error_avatar_permisos);
$smarty->assign("avatarCambiado", $cambio_avatar);

$smarty->assign("nombreCambiado", $cambio_nombre);

$smarty->assign("emailErrorFormato", $error_email);
$smarty->assign("emailCambiado", $cambio_email);

$smarty->assign("firmaCambiada", $cambio_firma);

$smarty->assign("passIncorrecto", $error_pass_actual);
$smarty->assign("errorPassRequisitos", $error_pass_req);
$smarty->assign("passRepeat", $error_pass_repeat);
$smarty->assign("passCambiado", $cambio_contraseña);

$smarty->display('vistas/perfil.tpl');


?>
