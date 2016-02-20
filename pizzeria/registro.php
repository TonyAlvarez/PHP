<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/registro_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Registro");

$smarty->assign("issetPost", isset($_POST['enviar']));

if (isset($_POST['enviar'])) {
    $smarty->assign("login", $_POST['login']);
    $smarty->assign("nombre", $_POST['nombre']);
    $smarty->assign("email", $_POST['email']);
    $smarty->assign("firma", $_POST['firma']);
}

$smarty->assign("loginVacio", isset($_POST['enviar']) && empty($_POST['login']));
$smarty->assign("loginExiste", $error_usuario_existe);

$smarty->assign("passVacio", isset($_POST['enviar']) && empty($_POST['pass']));
$smarty->assign("passRequisitos", $error_pass_req);

$smarty->assign("passRepeatVacio", isset($_POST['enviar']) && empty($_POST['pass_repeat']));
$smarty->assign("passNoCoincide", isset($_POST['enviar']) && !empty($_POST['pass']) && !empty($_POST['pass_repeat']) && $_POST['pass'] != $_POST['pass_repeat']);

$smarty->assign("nombreVacio", isset($_POST['enviar']) && empty($_POST['nombre']));

$smarty->assign("emailVacio", isset($_POST['enviar']) && empty($_POST['email']));
$smarty->assign("emailErrorFormato", $error_email);

$smarty->assign("firmaVacio", isset($_POST['enviar']) && empty($_POST['firma']));

$smarty->assign("terminos", isset($_POST['enviar']) && empty($_POST['terminos']));


$smarty->assign("registro", $registro_correcto);

$smarty->display('vistas/registro.tpl');