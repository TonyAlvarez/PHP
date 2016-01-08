<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 28/10/15
 * Time: 15:18
 */

function existe(&$fichero, $nombre) {

    while (($line = fgets($fichero)) !== false) {
        $array_contacto = explode(':', $line);
        if ($array_contacto[0] == $nombre)
            return true;
    }

    return true;
}

function alta(&$fichero, $nombre, $telefono) {
    fseek($fichero, filesize("./agenda.txt"));
    fwrite($fichero, $nombre . ":" . $telefono . "\n");

    fclose($fichero);
}

function modificar(&$fichero, $nombre, $nuevoTelefono) {
    $fichero_temp = fopen("./agenda_temp.txt", 'r+');
    while(($line = fgets($fichero)) !== false) {
        $array_contacto = explode(':', $line);
        if ($array_contacto[0] == $nombre)
            fputs($fichero_temp, $array_contacto[0] . ":" . $nuevoTelefono . "\n");
        else
            fputs($fichero_temp, $line);
    }

    fclose($fichero);
    fclose($fichero_temp);
    rename("./agenda_temp.txt", "./agenda.txt");
}

function baja(&$fichero, $nombre) {
    $fichero_temp = fopen("./agenda_temp.txt", 'r+');
    while(($line = fgets($fichero)) !== false) {
        $array_contacto = explode(':', $line);
        if ($array_contacto[0] != $nombre)
            fputs($fichero_temp, $line);
    }

    fclose($fichero);
    fclose($fichero_temp);
    rename("./agenda_temp.txt", "./agenda.txt");
}