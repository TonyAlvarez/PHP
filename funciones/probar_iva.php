<?php

include_once "calcular_iva.php";

$precio = 50;

print "Precio sin IVA: " . $precio . "€ <br />Precio con IVA: " . sumarIVA($precio) . "€";

?>