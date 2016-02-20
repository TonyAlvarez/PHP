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

            if (!$this->conexion = @mysqli_connect("localhost", "adminM1BiTSz", "F-l187E5HJSR")) {
                $this->regError(true);
                return 0;
            }

            mysqli_set_charset($this->conexion, "UTF8");

            $db = mysqli_select_db($this->conexion, "automoviles");

            if (!$db) {
                $this->regError();
                return 0;
            }

        }

        return 1;
    }

    function desconectar() {
        mysqli_close($this->conexion);
    }

    function ejecutar_consulta($consulta) {
        $this->query = mysqli_query($this->conexion, $consulta);

        if (mysqli_error($this->conexion)) {
            $this->regError();
            return 0;
        }

        return $this->query;
    }

    function siguiente() {
        $this->row = mysqli_fetch_object($this->query);

        return $this->row;
    }

    function mensajeError() {
        echo "Se ha registrado un error";
    }

    private function regError($conexion = false) {

        if ($conexion)
            $error = mysqli_connect_error();
        else
            $error = mysqli_error($this->conexion);

        $fichero = fopen("errores.txt", "a");
        fwrite($fichero, "[" . date("d/m/Y H:i:s") . "] " . $error . "\n");
        fclose($fichero);
    }

}