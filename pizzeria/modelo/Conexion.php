<?php

/**
 * Created by PhpStorm.
 * User: tony
 * Date: 21/12/15
 * Time: 20:13
 */
class Conexion
{

    private $con;

    function conectar()
    {

        if (!$this->con) {

            $this->con = @new mysqli("localhost", "root", "");
            //$this->con = @new mysqli("mysql.hostinger.es", "u870943103_pizza", "alualualu");

            /* verificar la conexión */
            if ($this->con->connect_errno) {
                printf("Error de conexión con MySQL: %s\n", $this->con->connect_error);
                die();
            }

            $this->con->set_charset("UTF8");

            //if (!$this->con->select_db("u870943103_pizza")) {
            if (!$this->con->select_db("pizzeria")) {
                echo "Se ha producido un error de conexion a la base de datos";
                die();
            }
        }
    }

    function ejecutar_consulta($consulta)
    {

        if ($this->con) {
            $result = $this->con->query($consulta);

            if (!$result) {
                echo "Se ha producido un error al ejecutar la consulta: " . $consulta;
                die();
            } else {
                return $result;
            }

        }

    }

    function desconectar()
    {
        if ($this->con)
            mysqli_close($this->con);
    }
}