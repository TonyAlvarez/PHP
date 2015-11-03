<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda telefónica</title>
</head>
<body>

<h1>Agenda telefónica</h1>

<?php

include_once "funciones.php";

//Variable que guarda los mensajes de ALTA, MODIFICIACION y BAJA
$mensaje = "<p></p>";

//Variable para comprobar si el nombre existe,
//ya que al borrarlo en la primera comprobación, si se intenta volver a buscar siempre devolverá false
$nombre_existe = false;

if (isset($_POST['enviar'])) {

    //Si ya tenemos datos en los hidden, los recuperamos en un array, en caso contrario creamos un array vacio.
    if ($_POST["array_values"] != null && $_POST["array_keys"] != null ) {
        $arrayValues = explode(',', $_POST['array_values']);
        $arrayKeys = explode(',', $_POST['array_keys']);
        $array_agenda = array_combine($arrayKeys, $arrayValues);
    } else {
        $array_agenda = array();
    }

    //COMPROBACIONES DEL FORMULARIO

    //El nombre siempre es obligatorio
    if ($_POST["nombre"] != null) {
        $nombre = $_POST["nombre"];

        // Si el nombre no existe en la agenda y el telefono no está vacio. Se llama a la función ALTA
        if (!existe($array_agenda, $nombre) && $_POST["telefono"] != null) {
            $telefono = $_POST["telefono"];
            alta($array_agenda, $nombre, $telefono);
            $mensaje = "<p style='color:blue'>El contacto se ha dado de alta en la agenda.</p>";
        } //Si el nombre ya existe y se indica un número de telefono, se llama a MODIFICAR
        elseif (existe($array_agenda, $nombre) && $_POST["telefono"] != null) {
            $telefono = $_POST["telefono"];
            $nombre_existe = true;
            modificar($array_agenda, $nombre, $telefono);
            $mensaje = "<p style='color:blue'>El contacto se ha modificado correctamente.</p>";
        } //Si el nombre ya existe y no se indica un número de telefono, se llama a BAJA
        elseif (existe($array_agenda, $nombre) && $_POST["telefono"] == null) {
            $nombre_existe = true;
            baja($array_agenda, $nombre);
            $mensaje = "<p style='color:blue'>El contacto se ha dado de baja correctamente.</p>";
        }
    }

    //Si el array está vacío avisamos
    if (count($array_agenda) == 0) {
        echo "<p>La agenda está vacia</p>";
    } else {

        //Si no está vacío pintamos la tabla
        echo "<table style='border: 1px solid #000; border-collapse: collapse; text-align: center' cellpadding='15'>";
        echo "<th style='border: 1px solid #000; background-color: darkolivegreen'>Nombre</th>";
        echo "<th style='border: 1px solid #000; background-color: darkolivegreen'>Teléfono</th>";

        //Y recorremos el array rellenando la tabla
        foreach ($array_agenda as $nombre => $telefono) {
            echo "<tr><td style='border: 1px solid #000;'>$nombre</td>";
            echo "<td style='border: 1px solid #000;'>$telefono</td></tr>";
        }

        echo "</table>";
    }
} else {
    //Antes de enviar el formulario, la agenda siempre está vacía
    echo "<p>La agenda está vacia</p>";
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

    <input type="hidden" name="array_values" value="<?php if (isset($_POST['enviar'])) echo implode(',', array_values($array_agenda))?>"/>
    <input type="hidden" name="array_keys" value="<?php if (isset($_POST['enviar'])) echo implode(',', array_keys($array_agenda))?>"/>

    <?php echo $mensaje; ?>

    <input type="submit" value="Enviar" name="enviar">

</form>

</body>
</html>