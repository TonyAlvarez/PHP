<?php

require_once "modelo/Conexion.php";


//Recuperar todos los pedidos de la BD
function getPedidos()
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM pedidos ORDER BY servido");

    $con->desconectar();

    return $result;
}

//Recuperar todos los pedidos de un usuario en concreto
function getPedidosUsuario($login)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM pedidos WHERE login = '" . $login . "'");

    $con->desconectar();

    return $result;
}

//Insertar pedido en la BD
function insertarPedido($pedido)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("INSERT INTO pedidos (`login`, `id_Masa`, `numIng`, `ingredientes`, `unidades`, `fechayhora`)" .
        " VALUES ('" . $pedido->getLogin() . "'," . $pedido->getIdMasa() . "," . $pedido->getNumIng() . ",'" . $pedido->getIdsIngredientes() . "'," . $pedido->getUnidades() . ",'" . $pedido->getFechayhora() . "')");

    $con->desconectar();

    return $result;

}

//Marcar un pedido como servido a partir de su ID
function servirPedido($idPedido)
{

    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE pedidos SET servido=1 WHERE id_Pedido = " . $idPedido);

    $con->desconectar();
}