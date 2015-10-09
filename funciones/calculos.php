<?php

/**
 *
“Gastos_por_valor” a la cual se le pasarán 4 parámetros (categoría, unidades, urgente e importe).
 *
“Gastos_por_referencia” contendrá los mismos parámetros que la anterior, pero devolverá el cálculo
del importe total por referencia en lugar de por valor.

 */


function gastosPorValor($categoria, $unidades, $importe, $urgente = false) {

    switch ($categoria) {
        case 1:
            $precio = 10;
            break;
        case 2:
            $precio = 20;
            break;
        case 3:
            $precio = 30;
            break;
        case 4:
            $precio = 40;
            break;
        default:
            $precio = 0;
            break;
    }

    $importe = $precio * 1.21 * $unidades;

    if ($urgente) {
        $importe = $importe * 1.05;
    }

    return $importe;
}

function frasesCiudades($pais, $capital = "Madrid", $habitantes = "muchos") {
    return "<br />La capital de " . $pais . " es " . $capital . " y tiene " . $habitantes . " habitantes.";
}


function diasASegundos($dias) {
    return $dias * 3600 * 24;
}


function convertirNegrita($frase) {
    return "<b>" . $frase . "</b>";
}

function crearHTML($titulo) {


    return "<html>
<head>
    <title>$titulo</title>
</head>
</html>";
}

function gastosPorReferencia($categoria, $unidades, &$importe, $urgente = false) {

    switch ($categoria) {
        case 1:
            $precio = 10;
            break;
        case 2:
            $precio = 20;
            break;
        case 3:
            $precio = 30;
            break;
        case 4:
            $precio = 40;
            break;
        default:
            $precio = 0;
            break;
    }

    $importe = $precio * 1.21 * $unidades;

    if ($urgente) {
        $importe = $importe * 1.05;
    }
}


?>