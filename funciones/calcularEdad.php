<?php


$fechaNacimiento = new DateTime('1990-08-22');

$fechaHoy = new DateTime();

$resul = $fechaNacimiento->diff($fechaHoy);

echo "</br>".$resul->format("%Y");


?>