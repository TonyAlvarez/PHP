<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 26/10/15
 * Time: 20:38
 */

$visitas = fopen("./visitas.txt", "c+") or die ("No se puede abrir el archivo");
$contador = fread($visitas, 8);
rewind($visitas);

if ($contador == null)
    $contador = 0;

$contador++;
fwrite($visitas, $contador);
fclose($visitas);

echo "Esta es la visita número: " . $contador;

?>





