<?php

require_once "modelo/gestionUsuarios.php";
require_once "modelo/clases/Usuario.php";

if (isset($_POST['cambiarTipo']) && isset($_POST['login'])) {
    //Poner o quitar privilegios de administracion al usuario
    cambiarTipo($_POST['login'], $_POST['tipo']);
} else if (isset($_POST['banear']) && isset($_POST['login'])) {
    eliminarUsuario($_POST['login']);
}


//Sacar los datos de los usuarios de la BD
$result = getUsuarios();

//Array de todos los usuarios de la BD
$arrayUsuarios = array();

//Crear instancias de Usuario a partir de los datos de la BD, y meterlos en un array.
while ($row = $result->fetch_assoc()) {
    $usuario = new Usuario();
    $usuario->setLogin($row['login']);
    $usuario->setEmail($row['email']);
    $usuario->setNombre($row['nombre']);
    $usuario->setFirma($row['firma']);
    $usuario->setAvatar($row['avatar']);
    $usuario->setTipo($row['tipo']);
    $arrayUsuarios[] = $usuario;
}

?>