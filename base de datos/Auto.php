<?php

/**
 * Created by PhpStorm.
 * User: tony
 * Date: 14/12/15
 * Time: 20:28
 */
class Auto
{

    private $id;
    private $marca;
    private $modelo;
    private $consumo;
    private $emisiones;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getConsumo()
    {
        return $this->consumo;
    }

    /**
     * @param mixed $consumo
     */
    public function setConsumo($consumo)
    {
        $this->consumo = $consumo;
    }

    /**
     * @return mixed
     */
    public function getEmisiones()
    {
        return $this->emisiones;
    }

    /**
     * @param mixed $emisiones
     */
    public function setEmisiones($emisiones)
    {
        $this->emisiones = $emisiones;
    }



}