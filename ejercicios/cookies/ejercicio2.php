<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 9/11/15
 * Time: 20:24
 */



if (isset ($_COOKIE["fecha"])) {
    echo "Tu última visita fue: " . $_COOKIE["fecha"];
} else {
    echo "Bienvenido al ejercicio 2 de cookies";
}


setcookie("fecha",date('Y-m-d H:i:s'));

?>