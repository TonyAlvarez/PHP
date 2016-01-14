<?php

/**
 * Created by PhpStorm.
 * User: tony
 * Date: 21/12/15
 * Time: 20:13
 */
class conexion
{

    private $con;

    function conectar()
    {

        if (!$this->con) {

            if (!$this->con = new mysqli("localhost", "root", "")) {
                echo "Se ha producido un error de conexion";
                die();
            }

            $this->con->set_charset("UTF8");


            if (!$this->con->select_db("curso")) {
                echo "Se ha producido un error de conexion a la base de datos";
                die();
            }
        }

    }



    function ejecutar_consulta($consulta) {

        if ($this->con) {
            $result = $this->con->query($consulta);

            if (!$result) {
                echo "Se ha producido un error al ejecutar la consulta";
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