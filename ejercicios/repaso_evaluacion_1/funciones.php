<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 12/11/15
 * Time: 15:24
 */


function setCabecera() {
    $fecha = new DateTime();

    echo $fecha->format("d-m-Y H:i:s");

    echo "<h1>Encuesta</h1>";

}

function contarVotosPiloto($nombre) {

    $ruta = "./resultados.txt";
    return substr_count(file_get_contents($ruta), $nombre);

}

function contarTotalVotos() {

    $ruta = "./resultados.txt";

    $total_votos = 0;
    $fichero = fopen($ruta, "r");
    while(!feof($fichero)){
        fgets($fichero);
        $total_votos++;
    }

    fclose($fichero);

    //Devolemos el resultado -1 porque cuenta la última línea en blanco
    return --$total_votos;
}

function calcularPorcentajeVoto($nombre) {
    return contarVotosPiloto($nombre) / contarTotalVotos() * 100;
}

function esGanador($nombre) {

    if (contarVotosPiloto($nombre) >= contarVotosPiloto("rossi") &&
        contarVotosPiloto($nombre) >= contarVotosPiloto("marquez") &&
        contarVotosPiloto($nombre) >= contarVotosPiloto("lorenzo") &&
        contarVotosPiloto($nombre) >= contarVotosPiloto("pedrosa") &&
        contarVotosPiloto($nombre) >= contarVotosPiloto("otro"))
        return true;

    return false;

}

function pintarResultadoPiloto($nombre) {

    if (esGanador($nombre))
        echo "<b>";

    if ($nombre == "rossi") {
        echo "<p>Valentino Rossi: ";
    } else if ($nombre == "marquez") {
        echo "<p>Marc Marquez: ";
    } else if ($nombre == "lorenzo") {
        echo "<p>Jorge Lorenzo: ";
    } else if ($nombre == "pedrosa") {
        echo "<p>Dani Pedrosa: ";
    } else if ($nombre == "otro") {
        echo "<p>Otro piloto: ";
    }
    printf("%.2f", calcularPorcentajeVoto($nombre));
    echo "%.</p>";

    if (esGanador($nombre))
        echo "</b>";

    for ($i = 0; $i < contarVotosPiloto($nombre); $i++)
        echo "=";

}

function pintarResultados() {
    pintarResultadoPiloto("rossi");
    pintarResultadoPiloto("marquez");
    pintarResultadoPiloto("lorenzo");
    pintarResultadoPiloto("pedrosa");
    pintarResultadoPiloto("otro");
}