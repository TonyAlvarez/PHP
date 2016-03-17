<?php

require_once "modelo/Conexion.php";

function getPizzas()
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM pizzas");

    $con->desconectar();

    return $result;

}

function getPizza($idPizza)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM pizzas WHERE id_pizza = " . $idPizza);

    $con->desconectar();

    return $result;

}

function cambiarStockPizza($idPizza, $enStock)
{

    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE pizzas SET stock=" . $enStock . " WHERE id_pizza = " . $idPizza);

    $con->desconectar();
}


function updatePizza($pizza)
{
    $con = new Conexion();

    $con->conectar();

    $query = "UPDATE pizzas SET nombrePizza = '" . $pizza->getNombre() . "', descripcion ='" . $pizza->getDescripcion() . "', ingredientes ='" . $pizza->getIdsIngredientes() . "', imagen ='" . $pizza->getImagen() . "' WHERE id_pizza = " . $pizza->getIdPizza();

    $con->ejecutar_consulta($query);

    $con->desconectar();
}

function insertarPizza($pizza)
{
    $con = new Conexion();

    $con->conectar();

    $query = "INSERT INTO pizzas (nombrePizza, descripcion, ingredientes, imagen) " .
        "VALUES ('" . $pizza->getNombre() . "', '" . $pizza->getDescripcion() . "', '" . $pizza->getIdsIngredientes() . "', '" . $pizza->getImagen() . "')";

    $con->ejecutar_consulta($query);

    $con->desconectar();

}

?>