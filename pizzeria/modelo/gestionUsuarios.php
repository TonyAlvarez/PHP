<?php

require_once "modelo/Conexion.php";


function getUsuarios()
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM usuario");

    $con->desconectar();

    return $result;
}


function getUsuario($login)
{

    $con = new Conexion();

    $con->conectar();

    $result = $con->ejecutar_consulta("SELECT * FROM usuario WHERE login = '" . $login . "'");

    $con->desconectar();

    return $result;
}


function updateUsuario($usuario)
{

    $con = new Conexion();

    $con->conectar();

    $update_query = "UPDATE usuario SET password = '" . $usuario->getPass() . "', nombre = '" . $usuario->getNombre() . "', email = '" . $usuario->getEmail() . "', firma = '" . $usuario->getFirma() . "', avatar = '" . $usuario->getAvatar() . "' WHERE login = '" . $usuario->getLogin() . "'";

    $result = $con->ejecutar_consulta($update_query);

    $con->desconectar();

    return $result;
}


function cambiarTipo($login, $tipo)
{

    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE usuario SET tipo =" . $tipo . " WHERE login = '" . $login . "'");

    $con->desconectar();
}


function insertarUsuario($usuario)
{
    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("INSERT INTO `usuario`(`login`, `password`, `nombre`, `email`, `firma`) " .
        " VALUES ('" . $usuario->getLogin() . "','" . $usuario->getPass() . "','" . $usuario->getNombre() . "','" . $usuario->getEmail() . "','" . $usuario->getFirma() . "')");

    $con->desconectar();
}

function eliminarUsuario($login)
{
    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("DELETE FROM `usuario` WHERE login = '" . $login . "'");

    $con->desconectar();
}


function restablecerAvatar($login)
{
    $con = new Conexion();

    $con->conectar();

    $con->ejecutar_consulta("UPDATE usuario SET avatar = 'avatar_defecto.jpg' WHERE login = '" . $login . "'");

    $con->desconectar();
}
