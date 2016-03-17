<?php

require_once "modelo/Conexion.php";

function getIngredientes()
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM ingredientes");

    $con->desconectar();

    return $result;

}

function getIngrediente($idIngrediente)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM ingredientes WHERE id_ingrediente = " . $idIngrediente);

    $con->desconectar();

    return $result;

}

function getNombreIngrediente($idIngrediente)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT nombreIng FROM ingredientes WHERE id_ingrediente = " . $idIngrediente);

    $con->desconectar();

    return $result->fetch_row()[0];
}

function cambiarStockIngrediente($idIngrediente, $enStock)
{

    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE ingredientes SET stock=" . $enStock . " WHERE id_ingrediente = " . $idIngrediente);

    $con->desconectar();
}

function updateIngrediente($ingrediente)
{
    $con = new Conexion();

    $con->conectar();

    $query = "UPDATE ingredientes SET nombreIng = '" . $ingrediente->getNombre() . "', descripcion ='" . $ingrediente->getDescripcion() . "', imagen ='" . $ingrediente->getImagen() . "' WHERE id_ingrediente = " . $ingrediente->getIdIngrediente();

    $con->ejecutar_consulta($query);

    $con->desconectar();
}


function insertarIngrediente($ingrediente)
{
    $con = new Conexion();

    $con->conectar();

    $query = "INSERT INTO ingredientes (nombreIng, descripcion, imagen) " .
        "VALUES ('" . $ingrediente->getNombre() . "', '" . $ingrediente->getDescripcion() . "', '" . $ingrediente->getImagen() . "')";

    $con->ejecutar_consulta($query);

    $con->desconectar();

}