<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda telefónica</title>
    <link rel="stylesheet" type="text/css" href="../../estilos.css">
</head>
<body>

<h1>Agenda telefónica</h1>

<?php

include_once "funciones_ficheros.php";

$ruta = "./agenda.txt";
$fichero = fopen($ruta, "c+") or die ("No se puede abrir el archivo");

//Variable que guarda los mensajes de ALTA, MODIFICIACION y BAJA
$mensaje = "<p></p>";

//Variable para comprobar si el nombre existe,
//ya que al borrarlo en la primera comprobación, si se intenta volver a buscar siempre devolverá false
$nombre_existe = false;

if (isset($_POST['enviar'])) {

    //COMPROBACIONES DEL FORMULARIO

    //El nombre siempre es obligatorio
    if ($_POST["nombre"] != null) {
        $nombre = $_POST["nombre"];

        // Si el nombre no existe en la agenda y el telefono no está vacio. Se llama a la función ALTA
        if (!existe($fichero, $nombre) && $_POST["telefono"] != null) {
            $telefono = $_POST["telefono"];
            alta($fichero, $nombre, $telefono);
            $mensaje = "<p style='color:blue'>El contacto se ha dado de alta en la agenda.</p>";
        } //Si el nombre ya existe y se indica un número de telefono, se llama a MODIFICAR
        elseif (existe($fichero, $nombre) && $_POST["telefono"] != null) {
            $telefono = $_POST["telefono"];
            $nombre_existe = true;
            modificar($fichero, $nombre, $telefono);
            $mensaje = "<p style='color:blue'>El contacto se ha modificado correctamente.</p>";
        } //Si el nombre ya existe y no se indica un número de telefono, se llama a BAJA
        elseif (existe($fichero, $nombre) && $_POST["telefono"] == null) {
            $nombre_existe = true;
            baja($fichero, $nombre);
            $mensaje = "<p style='color:blue'>El contacto se ha dado de baja correctamente.</p>";
        }
    }
}

$fichero = fopen($ruta, "r") or die ("No se puede abrir el archivo");

//Este método se llama para que limpie la cache
// y filesize devuelva el tamaño actualizado después de meterle mas datos
clearstatcache();

//Si el archivo está vacio mostramos un aviso
if (filesize($ruta) == 0) {
    echo "<p>No has añadido ningún contacto.</p>";
} else {
    //Si no está vacío pintamos la tabla
    echo "<table cellpadding='15'>";
    echo "<th>Nombre</th>";
    echo "<th>Destino</th>";

    //Y recorremos el archivo
    while (($line = fgets($fichero)) !== false) {
        $array_contacto = explode(':', $line);
        echo "<tr>";
        echo "<td>$array_contacto[0]</td>";
        echo "<td>$array_contacto[1]</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

<h2>Añadir contacto</h2>

<form method="POST">
    <label>Nombre:
        <input type="text" name="nombre"/>
    </label>
    <br/>

    <?php
    //Si el nombre está vacio se mostrará un aviso en color rojo
    if (isset($_POST['enviar']) && $_POST["nombre"] == null)
        echo "<p style='color:red'>¡El nombre es obligatorio!</p>";
    ?>

    <br/>
    <label>Teléfono:
        <input type="number" name="telefono"/>
    </label>
    <br/>

    <?php
    // Si el nombre no existe en la agenda y el teléfono está vacío se muestra otro aviso en rojo
    if (isset($_POST['enviar']) && $_POST["nombre"] != null && !$nombre_existe && $_POST["telefono"] == null)
        echo "<p style='color:red'>¡El teléfono es obligatorio!</p>";
    ?>

    <?php echo $mensaje; ?>

    <input type="submit" value="Enviar" name="enviar">

</form>

</body>
</html>