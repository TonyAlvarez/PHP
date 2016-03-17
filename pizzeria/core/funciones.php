<?php


/**
 *
 * Funcion que genera un ID único, la uso para darle un ID a cada pizza del carrito y así permitir al usuario eliminarla del mismo.
 *
 * Sacado de StackOverFlow: http://stackoverflow.com/a/12570561/710274
 */

function generarIdAleatorio()
{
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

    for ($i = 0; $i < 64; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

?>