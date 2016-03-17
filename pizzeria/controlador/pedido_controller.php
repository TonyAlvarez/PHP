<?php

if (isset($_POST['enviar'])) {

    require_once "modelo/clases/Pedido.php";
    require_once "modelo/gestionIngredientes.php";
    require_once "modelo/gestionMasas.php";
    require_once "core/funciones.php";

    $idIngredientes = "";

    foreach ($_POST['ingrediente'] as $check)
        $idIngredientes .= $check . ",";

    $idIngredientes = rtrim($idIngredientes, ',');

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
    require_once "modelo/gestionPedidos.php";
    require_once "modelo/gestionIngredientes.php";
    require_once "modelo/gestionMasas.php";
    require_once "modelo/clases/Pedido.php";


    if (isset($_POST['servir']) && isset($_POST['idPedido'])) {
        //Marcar el pedido como servido
        servirPedido($_POST['idPedido']);
    }

    $result = getPedidos();

    //Array de todos los pedidos de la BD
    $arrayPedidos = array();

    while ($row = $result->fetch_assoc()) {
        $pedido = new Pedido();
        $pedido->setLogin($row['login']);
        $pedido->setIdPedido($row['id_Pedido']);
        $pedido->setIdMasa($row['id_Masa']);
        $pedido->setNombreMasa(getNombreMasa($row['id_Masa']));
        $pedido->setIdsIngredientes($row['ingredientes']);
        $pedido->setPrecioTotal((getPrecioMasa($row['id_Masa']) + $row['numIng']) * $row['unidades']);
        $pedido->setUnidades($row['unidades']);
        $pedido->setFechayhora($row['fechayhora']);
        $pedido->setServido($row['servido']);
        $arrayPedidos[] = $pedido;
    }
}


?>