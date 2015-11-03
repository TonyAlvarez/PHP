<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 26/10/15
 * Time: 20:10
 */

copy("../ejercicio1.php", "fich_salida.txt");
echo "Número de bytes escritos: " . filesize("fich_salida.txt") . " Bytes";