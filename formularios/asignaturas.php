<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 16/10/15
 * Time: 19:08
 */


if (isset($_POST['enviar'])) {
    $name = $_POST['nombre'];
    $asignatura = $_POST['select'];

    echo 'El ususario ' . $name . ' ha elegido la asginatura ' . $asignatura;

}


?>