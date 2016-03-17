<?php


require_once "modelo/Conexion.php";

function getMasas()
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM masas");

    $con->desconectar();

    return $result;

}

function getMasa($idMasa)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM masas WHERE id_masa = " . $idMasa);

    $con->desconectar();

    return $result;

}

function getNombreMasa($idmasa)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT nombre FROM masas WHERE id_masa = " . $idmasa);

    $con->desconectar();

    return $result->fetch_row()[0];
}

function getPrecioMasa($idmasa)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT precio FROM masas WHERE id_masa = " . $idmasa);

    $con->desconectar();

    return $result->fetch_row()[0];
}


function cambiarStockMasa($idMasa, $enStock)
{

    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE masas SET stock=" . $enStock . " WHERE id_masa = " . $idMasa);

    $con->desconectar();
}


function updateMasa($masa)
{
    $con = new Conexion();

    $con->conectar();

    $query = "UPDATE masas SET nombre = '" . $masa->getNombre() . "', descripcion ='" . $masa->getDescripcion() . "', imagen ='" . $masa->getImagen() . "', tamano ='" . $masa->getTamano() . "', precio ='" . $masa->getPrecio() . "' WHERE id_masa = " . $masa->getId();

    $con->ejecutar_consulta($query);

    $con->desconectar();
}

function insertarMasa($masa)
{
    $con = new Conexion();

    $con->conectar();

    $query = "INSERT INTO masas (nombre, descripcion, tamano, precio, imagen) " .
        "VALUES ('" . $masa->getNombre() . "', '" . $masa->getDescripcion() . "', " . $masa->getTamano() . ", " . $masa->getPrecio() . ", '" . $masa->getImagen() . "')";

    $con->ejecutar_consulta($query);

    $con->desconectar();
}
