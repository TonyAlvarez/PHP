<?php

include_once 'interfaz.php';

setCabecera();

echo '<h2>Estadísticas</h2>';

//La ruta del archivo
$rutaEncuesta = './encuesta.txt';

//Comprobamos que existe
if (file_exists($rutaEncuesta)) {

    //Abrimos el archivo
    $ficheroEncuesta = fopen($rutaEncuesta, 'c+') or die('Error al leer la encuesta');

    //Cremos dos variables
    $votosSi = 0;
    $votosNo = 0;

    //Leemos el archivo linea a linea, y vamos aumentando la variable respectiva
    while (false != ($linea = fgets($ficheroEncuesta))) {
        if ($linea == "si\n")
            $votosSi++;
        else
            $votosNo++;
    }

    //Cerramos el archivo
    fclose($ficheroEncuesta);

    //Imprimimos el resultado
    echo '<ul>';
    echo '<li>A ' . $votosSi . ' personas les ha gustado la página</li>';
    echo '<br />';
    echo '<li>A ' . $votosNo . ' personas no les ha gustado la página</li>';
    echo '</ul>';
} else {
    //Si no existe mostramos un mensaje
    echo 'Todavía no hay ningún dato en la encuesta';
}

//Metemos el pie de página
piePagina();

?>