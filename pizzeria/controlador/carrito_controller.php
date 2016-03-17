<?php

require_once "modelo/gestionPedidos.php";
require_once "modelo/gestionIngredientes.php";
require_once "modelo/gestionMasas.php";
require_once "modelo/clases/Pedido.php";

if (isset($_POST['confirmar'])) {

    /**
     *  Deserializar objetos Pedidos desde la session
     *
     *  Sacado de StackOverflow;
     *  http://stackoverflow.com/a/1442271/710274
     */
    foreach ($_SESSION['user']['pedidos'] as $ped) {
        $pedido = unserialize($ped);

        //La hora del pedido es la hora a la que se confirma, no a la que se añade al carrito, por lo tanto hay que ponerla ahora
        $horaPedido = ucfirst(strftime("%d/%m/%Y a las %H:%M:%S"));
        $pedido->setFechayhora($horaPedido);

        //Insertar los pedidos en la BD
        insertarPedido($pedido);
    }

    //Eliminar los pedidos del carrito
    unset($_SESSION['user']['pedidos']);

} else {

    //Eliminar un pedido del carrito
    if (isset($_POST['eliminar']) && isset($_POST['idPedido']))
        unset($_SESSION['user']['pedidos'][$_POST['idPedido']]);

    //Mostrar todos los pedidos del carrito, si los hay
    if (isset($_SESSION['user']['pedidos'])) {

        $arrayPedidos = array();
        /**
         *  Crear un array de Pedidos, deserializandolos desde la session
         *
         *  Sacado de StackOverflow;
         *  http://stackoverflow.com/a/1442271/710274
         */
        foreach ($_SESSION['user']['pedidos'] as $pedido)
            $arrayPedidos[] = unserialize($pedido);

        $unidadesTotales = 0;
        $precioTotal = 0;

        //Calcular las unidades y el precio total para mostrarlo en la ultima fila de la tabla del carrito
        foreach ($arrayPedidos as $ped) {
            $unidadesTotales += $ped->getUnidades();
            $precioTotal += $ped->getPrecioTotal();
        }
    }
}


?>