<?php

require_once "modelo/gestionMasas.php";
require_once "modelo/clases/Masa.php";

if (isset($_POST['cambiarStock']) && isset($_POST['idMasa'])) {
    //Poner o quitar la masa del stock
    cambiarStockMasa($_POST['idMasa'], $_POST['stock']);
}

$result = getMasas();

//Array de todas las masas de la BD
$arrayMasas = array();

while ($row = $result->fetch_assoc()) {
    $masa = new Masa();
    $masa->setId($row['id_masa']);
    $masa->setNombre($row['nombre']);
    $masa->setDescripcion($row['descripcion']);
    $masa->setPrecio($row['precio']);
    $masa->setTamano($row['tamano']);
    $masa->setImagen($row['imagen']);
    $masa->setStock($row['stock']);
    $arrayMasas[] = $masa;
}

?>