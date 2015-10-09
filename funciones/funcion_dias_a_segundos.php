<?php


function diasASegundos($dias) {
    return $dias * 3600 * 24;
}

$dias = 20;

echo "$dias dias son " . diasASegundos($dias) . " segundos";