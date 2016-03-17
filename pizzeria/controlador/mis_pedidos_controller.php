<?php

require_once "modelo/gestionPedidos.php";
require_once "modelo/gestionIngredientes.php";
require_once "modelo/gestionMasas.php";
require_once "modelo/clases/Pedido.php";

if (isset($_POST['servir']) && isset($_POST['idPedido'])) {
    servirPedido($_POST['idPedido']);
}

$result = getPedidosUsuario($_SESSION['user']['login']);

$arrayPedidos = array();

while ($row = $result->fetch_assoc()) {
    $pedido = new Pedido();
    $pedido->setLogin($row['login']);
    $pedido->setIdPedido($row['id_Pedido']);
    $pedido->setIdMasa($row['id_Masa']);
    $pedido->setNombreMasa(getNombreMasa($row['id_Masa']));
    $pedido->setIdsIngredientes($row['ingredientes']);
    $pedido->setPrecioTotal((getPrecioMasa($row['id_Masa']) + $pedido->getNumIng()) * $row['unidades']);
    $pedido->setUnidades($row['unidades']);
    $pedido->setFechayhora($row['fechayhora']);
    $pedido->setServido($row['servido']);
    $arrayPedidos[] = $pedido;
}

?>