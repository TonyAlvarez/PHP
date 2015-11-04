<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/11/15
 * Time: 2:37
 */


$fichero = fopen("./datos.txt", "r") or die ("No se puede abrir el archivo");

while (($line = fgets($fichero)) !== false)
    echo nl2br($line);

fclose($fichero);
