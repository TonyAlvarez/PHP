<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda de viajes</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

<h1>Agenda de viajes travelmas</h1>

<?php

$ruta = "./viajes.txt";
$fichero = fopen($ruta, "a+") or die ("No se puede abrir el archivo");

//Si se envia en formulario se comprueba que todos las campos tengan algún dato y se añade una linea al archivo
if (isset($_POST['enviar'])) {

    if ($_POST["nombre"] != null && $_POST["destino"] != null && $_POST["duracion"] != null && $_POST["salida"] != null) {
        $nombre = $_POST["nombre"];
        $destino = $_POST["destino"];
        $duracion = $_POST["duracion"];
        $salida = $_POST["salida"];


        fwrite($fichero, $nombre . ":" . $destino . ":" . $duracion . ":" . $salida . "\n");
    } else {
        echo "<p style='color:red'>!Todos los datos son obligatorios!</p>";
    }

    //Ponemos el puntero al inicio para leer el fichero e imprimir los viajes
    rewind($fichero);
}


//Si el está vacio mostramos un aviso
if (filesize($ruta) == 0) {
    echo "<p>No has añadido ningún destino.</p>";
} else {
    //Si no está vacío pintamos la tabla
    echo "<table cellpadding='15'>";
    echo "<th>Nombre</th>";
    echo "<th>Destino</th>";
    echo "<th>Duración</th>";
    echo "<th>Salida</th>";

    //Y recorremos el archivo
    while (($line = fgets($fichero)) !== false) {
        $array_viaje = explode(':', $line);
        echo "<tr>";
        echo "<td>$array_viaje[0]</td>";
        echo "<td>$array_viaje[1]</td>";
        echo "<td>$array_viaje[2]</td>";
        echo "<td>$array_viaje[3]</td>";
        echo "</tr>";
    }

    echo "</table>";
}


fclose($fichero);
?>

<h2>Añadir contacto</h2>

<form method="POST">

    <table cellpadding="5px">
        <tr>
            <td>Introduzca el nombre del circuito</td>
            <td><input type="text" name="nombre"/></td>
        </tr>

        <tr>
            <td>Introduzca el destino</td>
            <td><input type="text" name="destino"/></td>
        </tr>

        <tr>
            <td>Introduzca la duración</td>
            <td><input type="text" name="duracion"/></td>
        </tr>

        <tr>
            <td>Introduzca los dias de salida</td>
            <td><input type="text" name="salida"/></td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit" value="Enviar" name="enviar"></td>
        </tr>
    </table>
</form>

</body>
</html>