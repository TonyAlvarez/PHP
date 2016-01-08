<?php

$nuevaFecha = new DateTime('2011-01-05');
$nuevaFecha->modify("+1 day");
echo "\n".$nuevaFecha->format("Y-m-d");


$timespan = 10;
$d1 = new DateTime();
$d2 = new DateTime();
$d2->add(new DateInterval('PT'.$timespan.'S'));
$resul = $d2->diff($d1);

echo "</br>".$resul->format("%s");


?>