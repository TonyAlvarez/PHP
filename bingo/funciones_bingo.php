<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 18/11/15
 * Time: 15:37
 */

function iniciarBingo($numCartones)
{
    //Lista de los ficheros que hay que eliminar para reiniciar la partida
    $rutaCartones = "./cartones.txt";
    $rutaBolas = "./bolas.txt";
    $rutaRestantes = "./restantes.txt";
    $rutaBingo = "./bingo.txt";
    $rutaLinea = "./linea.txt";

    //Borra los archivos si ya existen
    if (file_exists($rutaCartones))
        unlink($rutaCartones);

    //Borra el archivo si ya existe
    if (file_exists($rutaBolas))
        unlink($rutaBolas);

    //Borra el archivo si ya existe
    if (file_exists($rutaRestantes))
        unlink($rutaRestantes);

    //Borra el archivo si ya existe
    if (file_exists($rutaBingo))
        unlink($rutaBingo);

    //Borra el archivo si ya existe
    if (file_exists($rutaLinea))
        unlink($rutaLinea);

    //Generamos las 90 bolas y las metemos en el fichero
    $ficheroRestantes = fopen($rutaRestantes, "c+") or die ("No se puede abrir el archivo");

    $arrayTemp = array();

    for ($i = 0; $i < 90; $i++)
        $arrayTemp[$i] = $i + 1;

    shuffle($arrayTemp);

    for ($i = 0; $i < 90; $i++) {
        fwrite($ficheroRestantes, $arrayTemp[$i]);
        if ($i != 89)
            fwrite($ficheroRestantes, ",");
    }
    fclose($ficheroRestantes);

    //Generamos los cartones
    for ($i = 0; $i < $numCartones; $i++)
        generarCarton();

    //Pintamos el Bingo
    pintarNumeros();
    pintarCartones();
}

//Contar las bolas restantes
/**
 *
 */
function contarRestantes()
{

    $rutaRestantes = "./restantes.txt";
    $ficheroRestantes = fopen($rutaRestantes, "c+") or die ("No se puede abrir el archivo");
    $arrayBolasRestantes = explode(',', fgets($ficheroRestantes));
    fclose($ficheroRestantes);

    return count($arrayBolasRestantes);
}

//Sacar una bola
function sacarBola()
{
    $rutaRestantes = "./restantes.txt";

    //Leemos el archivo y creamos un array con su contenido
    $ficheroRestantes = fopen($rutaRestantes, "c+") or die ("No se puede abrir el archivo");
    $arrayBolasRestantes = explode(',', fgets($ficheroRestantes));
    fclose($ficheroRestantes);

    //Nos cargamos el contenido del archivo
    $ficheroRestantes = fopen($rutaRestantes, "w+") or die ("No se puede abrir el archivo");

    //Mezclamos el array, sacamos un número y lo volvemos a meter en el fichero de restantes
    $bolaSacada = $arrayBolasRestantes[0];

    //Quitamos el numero sacado del array
    unset($arrayBolasRestantes[0]);
    $arrayBolasRestantes = array_merge($arrayBolasRestantes);

    for ($i = 0; $i < count($arrayBolasRestantes); $i++)
        if (is_numeric($arrayBolasRestantes[$i])) {
            fwrite($ficheroRestantes, $arrayBolasRestantes[$i]);
            if ($i != (count($arrayBolasRestantes) - 1))
                fwrite($ficheroRestantes, ",");
        }

    fclose($ficheroRestantes);

    //Añadimos la bola sacada al fichero de bolas
    $rutaSacadas = "./bolas.txt";
    $ficheroSacadas = fopen($rutaSacadas, "a+") or die ("No se puede abrir el archivo");
    fwrite($ficheroSacadas, $bolaSacada . ",");
    fclose($ficheroSacadas);

    pintarNumeros($bolaSacada);

    pintarCartones($bolaSacada);
}

//Genera un cartón
function generarCarton()
{

    $numeros = array();
    $arrayFilas = array();
    $arrayVacios = array();

    //Generamos dos números para cada decena
    generarNumerosDecena($numeros, 1, 9);
    generarNumerosDecena($numeros, 10, 19);
    generarNumerosDecena($numeros, 20, 29);
    generarNumerosDecena($numeros, 30, 39);
    generarNumerosDecena($numeros, 40, 49);
    generarNumerosDecena($numeros, 50, 59);
    generarNumerosDecena($numeros, 60, 69);
    generarNumerosDecena($numeros, 70, 79);
    generarNumerosDecena($numeros, 80, 90);

    sort($numeros);

    //Dividir el array de números en un array bidemensional.
    for ($i = 0; $i <= 2; $i++) {
        for ($x = 0; $x <= 8; $x++) {
            $arrayFilas[$i][$x] = $numeros[$x * 3 + $i];
        }
    }

    generarVacios($arrayVacios);

    guardarCarton($arrayFilas, $arrayVacios);

}

//Funcion que genera tres números por cada decena (entre min y max) sin que se repita en el array
function generarNumerosDecena(&$numeros, $min, $max)
{
    for ($i = 0; $i <= 2; $i++) {
        //Generas un aleatorio entre min y max
        $rand = rand($min, $max);

        //Comprobamos que el numero no esté en el array
        while (in_array($rand, $numeros))
            $rand = rand($min, $max);

        //Metemos el número en el array
        array_push($numeros, $rand);
    }
}

//Genera las posiciones de los vacios
function generarVacios(&$arrayVacios)
{

    $arrayTemp = array();

    //Generamos 1 vacio en cada fila y los desordenamos
    for ($i = 0; $i <= 8; $i++) {
        array_push($arrayTemp, $i);
    }

    shuffle($arrayTemp);
    //Metemos 3 de los vacios anteriores en cada fila
    for ($x = 0; $x <= 2; $x++) {
        for ($i = 0; $i <= 2; $i++) {
            $pos = $arrayTemp[$x * 3 + $i];
            $arrayVacios[$x][$i] = $pos;
        }

        //Generamos otro aleatorio en cada fila, sin que coincida con creados anteriormente
        $rand = rand(0, 8);

        while (in_array($rand, $arrayVacios[$x]))
            $rand = rand(0, 8);

        $arrayVacios[$x][3] = $rand;
    }

}

function guardarCarton(&$arrayFilas, &$arrayVacios)
{

    $ruta = "./cartones.txt";

    //Abrimos el fichero donde guardaremos el cartón
    $fichero = fopen($ruta, "a+") or die ("No se puede abrir el archivo");

    for ($i = 0; $i <= 2; $i++) {
        for ($x = 0; $x <= 8; $x++) {
            if (in_array($x, $arrayVacios[$i])) {
                fwrite($fichero, "0");
            } else {
                fwrite($fichero, "" . $arrayFilas[$i][$x]);
            }

            fwrite($fichero, ",");
        }

        if ($i < 2)
            fwrite($fichero, ":");
    }

    fwrite($fichero, "\n");

    fclose($fichero);

}

function pintarCartones($bolaSacada = 0)
{

    //Ficheros donde guardamos los cartones y las bolas que ya han salido
    $rutaCartones = "./cartones.txt";
    $rutaBolas = "./bolas.txt";

    $ficheroCartones = fopen($rutaCartones, "c+") or die ("No se puede abrir el archivo");
    $ficheroBolas = fopen($rutaBolas, "c+") or die ("No se puede abrir el archivo");

    //Las bolas se guardan en una sola linea, la leemos para tener las bolas en un array
    $arrayBolas = explode(',', fgets($ficheroBolas));

    echo '<div id="tablas">';

    //Número del carton, para cantar línea o bingo
    $numCarton = 0;

    //Leemos cartón a cartón
    while (($line = fgets($ficheroCartones)) !== false) {

        $numCarton++;

        //Variable para saber si el cartón actual tiene que cantar bingo
        $bingo = true;

        //Abrimos la tabla
        echo "<table>";
        echo "<th>1-9</th>";
        echo "<th>10-19</th>";
        echo "<th>20-29</th>";
        echo "<th>30-39</th>";
        echo "<th>40-49</th>";
        echo "<th>50-59</th>";
        echo "<th>60-69</th>";
        echo "<th>70-79</th>";
        echo "<th>80-90</th>";

        $arrayTemp = explode(':', $line);
        $arrayFilas = array();

        for ($i = 0; $i <= 2; $i++) {
            $arrayFilas[$i] = explode(',', $arrayTemp[$i]);
        }

        //Bucle para las líneas del cartón
        for ($i = 0; $i < count($arrayFilas); $i++) {

            //Variable para saber si el cartón actual tiene que cantar línea
            $linea = true;

            echo "<tr>";

            for ($x = 0; $x <= 8; $x++) {

                if ($arrayFilas[$i][$x] == 0) {
                    echo '<td class="vacio">#</td>';
                } else if ($arrayFilas[$i][$x] == $bolaSacada) {
                    echo "<td class='numero-recien-sacado'>" . $arrayFilas[$i][$x] . "</td>";
                } else if (in_array($arrayFilas[$i][$x], $arrayBolas)) {
                    echo "<td class='numero-sacado'>" . $arrayFilas[$i][$x] . "</td>";
                } else {
                    $bingo = false;
                    $linea = false;
                    echo "<td>" . $arrayFilas[$i][$x] . "</td>";
                }
            }

            echo "</tr>";

            //Si la variable $linea sigue siendo true, y todavía no se ha cantado, se canta linea, se canta linea y se crea un archivo para saber que ya se ha cantado
            if ($linea && !file_exists('./linea.txt')) {
                $fichero_linea = fopen('./linea.txt', 'w+');
                fclose($fichero_linea);
                echo "<script type='text/javascript'>alert('El cartón número $numCarton ha cantado línea!');</script>";
            }
        }

        //Si la variable $bingo sigue siendo true, y todavía no se ha cantado, se canta bingo y se crea un archivo para saber que ya se ha cantado.
        if ($bingo && !file_exists('./bingo.txt')) {
            $fichero_bingo = fopen('./bingo.txt', 'w+');
            fclose($fichero_bingo);
            echo "<script type='text/javascript'>alert('El cartón número $numCarton ha cantado bingo!');</script>";
        }

        echo "</table>";
    }

    echo '</div>';

    fclose($ficheroCartones);
}

function pintarNumeros($bolaSacada = 0)
{
    $ruta = "./bolas.txt";

//Abrimos el fichero donde guardaremos el cartón
    $fichero = fopen($ruta, "c+") or die ("No se puede abrir el archivo");

    $arrayBolas = explode(',', fgets($fichero));

    echo '<div id="cartones">';
    echo '<div id="div_izquierda">';

    if ($bolaSacada != 0) {
        echo "<p id='p_restantes'><span id='span_restantes'>";
        echo contarRestantes();
        echo "</span> números restantes.</p>";

        echo "<span id='bola_sacada'>$bolaSacada</span>";
    }

    //Formulario, para sacar bolas o reiniciar la partida
    echo '<form method="POST">';
    if (finDelJuego()) {
        echo '<button class="reiniciar" type="submit">Reiniciar partida</button>';
    } else {
        echo '<button class="sacar_bola" type="submit" name="sacarBola">Sacar número</button>';
        if ($bolaSacada != 0)
            echo '<br /><button class="reiniciar" type="submit">Reiniciar partida</button>';
    }
    echo '</form>';


    echo '</div>';
    echo '<div id="div_derecha">';

    //Abrimos la tabla
    echo "
    <table>";

    for ($i = 0; $i <= 8; $i++) {

        echo "
        <tr>";

        for ($x = 1; $x <= 10; $x++) {

            if ($bolaSacada == $i * 10 + $x)
                echo "
            <td class='numero-recien-tachado'>" . ($i * 10 + $x) . "</td>
            ";
            else if (in_array(($i * 10 + $x), $arrayBolas))
                echo "
            <td class='numero-tachado'>" . ($i * 10 + $x) . "</td>
            ";
            else
                echo "
            <td>" . ($i * 10 + $x) . "</td>
            ";
        }


        echo "
        </tr>
        ";
    }

    echo "
    </table>
</div></div>";
}

function finDelJuego()
{
    $rutaRestantes = "./restantes.txt";
    if (file_exists($rutaRestantes) && filesize($rutaRestantes) == 0)
        return true;

    $rutaBingo = "./bingo.txt";
    if (file_exists($rutaBingo))
        return true;

    return false;
}