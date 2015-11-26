<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 12/11/15
 * Time: 15:23
 */

include_once "funciones.php";

$ruta= "./resultados.txt";
//Abrimos el archivo con el puntero al final
$fichero = fopen($ruta, "a+") or die ("No se puede abrir el archivo");

//Si se envia en formulario se comprueba que todos las campos tengan algún dato y se añade una linea al archivo
if (isset($_POST['enviar']) && isset($_POST['piloto']) && !isset($_COOKIE["votado"])) {

    setcookie("votado", true);
    $radio = $_POST['piloto'];
    fwrite($fichero, $radio . "\n");
}

fclose($fichero);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Encuesta</title>
</head>
<body>

<?php setCabecera(); ?>

<form method="POST">

    <span>¿Quién crees que ganará el próximo mundial de Moto GP?:</span> <br /><br />
    <input type="radio" name="piloto" value="rossi"/> Valentino Rossi <br />
    <input type="radio" name="piloto" value="marquez"/> Marc Marquez <br />
    <input type="radio" name="piloto" value="lorenzo"/> Jorge Lorenzo <br />
    <input type="radio" name="piloto" value="pedrosa"/> Dani Pedrosa <br />
    <input type="radio" name="piloto" value="otro"/> Otro piloto <br />
    <br />
    <?php

    if (isset($_POST['enviar']) && isset($_POST['piloto']) || isset($_COOKIE["votado"]))
        echo "<p>Gracias por tu voto</p><a href='resultados.php'>Ver resultados de la encuesta</a>";
    else
        echo '<input type="submit" value="Enviar" name="enviar">';

    if (isset($_POST['enviar']) && !isset($_POST['piloto']))
        echo "<p style='color:red'>¡No has elegido ninguna opción!</p>";

    ?>

</form>


</body>
</html>