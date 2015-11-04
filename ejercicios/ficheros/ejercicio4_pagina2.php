<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/11/15
 * Time: 0:31
 */

if (isset($_POST['enviar']) && $_POST["nombre"] != null && $_POST["comentario"] != null) {

    $nombre = $_POST["nombre"];
    $comentario = $_POST["comentario"];
    $separador = "--------------------------------------------------------";

    $entrada = <<<EOD
$separador
$nombre
$comentario

EOD;

    $fichero = fopen("./datos.txt", "a+") or die ("No se puede abrir el archivo");

    fwrite($fichero, $entrada);
    fclose($fichero);

    echo "Los datos se gardaron correctamente:";
    echo "<br />" . $separador . "<br />" . $nombre . "<br />" . $comentario . "<br />" . $separador;

    echo "<br /><a href='ejercicio4_pagina3.php'><button>Ver fichero</button></a>";

} else {
    echo "<p style='color:red'>¡El nombre y el comentario son obligatorios.</p>";
    echo "<a href='ejercicio4_pagina1.php'><button>Atrás</button></a>";
}
?>