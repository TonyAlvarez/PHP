<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 9/11/15
 * Time: 20:20
 */


$visitas = 0;

if (isset ($_COOKIE["visitas"]))
    $visitas = $_COOKIE["visitas"];

$visitas++;
setcookie("visitas", $visitas);
echo "Visitas: " . $visitas;

?>