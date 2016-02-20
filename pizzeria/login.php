<?php

require_once "core/smarty_manager.php";
require_once "core/session_start.php";
require_once "controlador/login_controller.php";
require_once "core/session_manager.php";

$smarty->assign("pagina", "Login");

$smarty->assign("issetPost", isset($_POST['enviar']));

if (isset($_POST['enviar']))
    $smarty->assign("login", $_POST['login']);

$smarty->assign("loginVacio", isset($_POST['enviar']) && empty($_POST['login']));
$smarty->assign("loginNoExiste", $error_usuario_no_existe);

$smarty->assign("passVacio", isset($_POST['enviar']) && empty($_POST['pass']));
$smarty->assign("passIncorrecto", $error_pass_incorrecto);

$smarty->assign("intentosLogin", $intentos);

if ($intentos >= 3)
    $smarty->assign("srcCaptcha", $_SESSION['captcha']['image_src']);

$smarty->assign("mostrarCaptcha", $mostrarCaptcha);
$smarty->assign("captchaVacio", $error_captcha_vacio);
$smarty->assign("captchaIncorrecto", $error_captcha_incorrecto);

$smarty->display('vistas/login.tpl');


?>
