<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 28/10/15
 * Time: 15:18
 */


function existe(&$array, $nombre) {
    //La función array_key_existe devuelve verdadero si la entrada existe o falso en caso contrario
    return array_key_exists($nombre, $array);
}

function alta(&$array, $nombre, $telefono) {
    //Añadimos los datos al array
    $array[$nombre] = $telefono;
}


function modificar(&$array, $nombre, $nuevoTelefono) {
    //Cambiamos el valor de la entrada correspondiente
    $array[$nombre] = $nuevoTelefono;
}

function baja(&$array, $nombre) {
    //Eliminamos la entrada del array
    unset($array[$nombre]);
}