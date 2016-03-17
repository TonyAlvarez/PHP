<?php

require_once "modelo/gestionPizzas.php";
require_once "modelo/gestionIngredientes.php";
require_once "modelo/gestionMasas.php";
require_once "modelo/clases/Pizza.php";
require_once "modelo/clases/Pedido.php";
require_once "core/funciones.php";

if (isset($_POST['enviar'])) {
    $idIngredientes = rtrim($_POST['ingredientes'], ',');

    $idUnicoPedido = generarIdAleatorio();

    //Crear un nuevo Pedido.
    $nuevoPedido = new Pedido();
    $nuevoPedido->setIdPedido($idUnicoPedido);
    $nuevoPedido->setLogin($_SESSION["user"]["login"]);
    $nuevoPedido->setIdMasa($_POST['masa']);
    $nuevoPedido->setNombreMasa(getNombreMasa($_POST['masa']));
    $nuevoPedido->setIdsIngredientes($idIngredientes);
    $nuevoPedido->setUnidades($_POST['cantidad']);
    $nuevoPedido->setPrecioTotal((getPrecioMasa($_POST['masa']) + $nuevoPedido->getNumIng()) * $_POST['cantidad']);


    /**
     *  Añadir el pedido al carrito, serializando el objeto
     *
     *  Sacado de StackOverflow;
     *  http://stackoverflow.com/a/1442271/710274
     */
    $_SESSION['user']['pedidos'][$idUnicoPedido] = serialize($nuevoPedido);

} else {

    if (isset($_POST['cambiarStock']) && isset($_POST['idPizza'])) {
        //Poner o quitar la pizza del stock
        cambiarStockPizza($_POST['idPizza'], $_POST['stock']);
    }

    $result = getPizzas();

    //Array de todas las pizzas de la BD
    $arrayPizzas = array();

    while ($row = $result->fetch_assoc()) {
        $pizza = new Pizza();
        $pizza->setIdPizza($row['id_pizza']);
        $pizza->setNombre($row['nombrePizza']);
        $pizza->setDescripcion($row['descripcion']);
        $pizza->setIdsIngredientes($row['ingredientes']);
        $pizza->setImagen($row['imagen']);
        $pizza->setStock($row['stock']);
        $arrayPizzas[] = $pizza;
    }
}


?>