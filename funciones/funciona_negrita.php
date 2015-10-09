<?php


function convertir_negrita($frase) {
    return "<b>" . $frase . "</b>";
}

$frase = "Hola caracola";

echo "Frase normal: " . $frase;
echo "<br />";
echo "Frase negrita: " . convertir_negrita($frase);


?>