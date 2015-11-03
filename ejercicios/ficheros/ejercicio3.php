<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 26/10/15
 * Time: 20:57
 */

$ruta = "./";

if (is_dir($ruta)) {
    if ($directorio = opendir($ruta)) {
        while (($file = readdir($directorio)) !== false) {
            if (filetype($ruta . $file) == 'file')
                echo "<b>$file</b> - Tamaño: " .filesize($ruta. $file).' bytes - ' . "Última modificación: " . date ("d/m/Y H:i:s.", filemtime($file)) . "<br />";
            else
                echo "$file " . "<br />";

        }
        closedir($directorio);
    }
}
?>