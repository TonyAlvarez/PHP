<?php

require_once "modelo/gestionIngredientes.php";
require_once "modelo/clases/Ingrediente.php";

if (isset($_POST['cambiarStock']) && isset($_POST['idIngrediente'])) {

    //Poner o quitar el ingrediente del stock
    cambiarStockIngrediente($_POST['idIngrediente'], $_POST['stock']);

}

$result = getIngredientes();

//Array de todos los ingredientes de la BD
$arrayIngredientes = array();

while ($row = $result->fetch_assoc()) {
    $ingrediente = new Ingrediente();
    $ingrediente->setIdIngrediente($row['id_ingrediente']);
    $ingrediente->setNombre($row['nombreIng']);
    $ingrediente->setDescripcion($row['descripcion']);
    $ingrediente->setImagen($row['imagen']);
    $ingrediente->setStock($row['stock']);
    $arrayIngredientes[] = $ingrediente;
}

?>