<?php

/**
 * Created by PhpStorm.
 * User: tony
 * Date: 9/12/15
 * Time: 16:40
 */
class MySQLDataSource
{

    private $conexion;
    private $query;
    private $row;

    function conectar() {

        if (!$this->conexion) {

            $this->conexion = mysqli_connect("localhost", "root", "") or die (mysqli_error($this->conexion));

            if (!$this->conexion)
                $this->regError();

            mysqli_set_charset($this->conexion, "UTF-8");

            $db = mysqli_select_db($this->conexion, "automoviles");

            if (!$db)
                $this->regError();

        } else {
            echo "La conexión ya está establecida";
        }
    }

    function desconectar() {
        mysqli_close($this->conexion);
    }

    function ejecutar_consulta($consulta) {
        $this->query = mysqli_query($this->conexion, $consulta);

        if (mysqli_error($this->conexion)) {
            $this->regError();
        }

        return $this->query;
    }

    function siguiente() {
        $this->row = mysqli_fetch_object($this->query);

        return $this->row;
    }

    function mensajeError() {
        echo "Se ha registrado un error";
        $this->regError();
    }

    private function regError() {
        $error = mysqli_error($this->conexion);

        $fichero = fopen("errores.txt", "a");
        fwrite($fichero, "[" . date("d/m/Y H:i:s") . "] " . $error . "\n");
        fclose($fichero);
    }

}