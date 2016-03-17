<?php

class Pedido
{
    private $idPedido;
    private $login;
    private $idMasa;
    private $nombreMasa;
    private $numIng;
    private $idsIngredientes;
    private $nombresIngredientes;
    private $unidades;
    private $fechayhora;
    private $servido;
    private $precioTotal;

    public function getIdPedido()
    {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getIdMasa()
    {
        return $this->idMasa;
    }

    public function setIdMasa($idMasa)
    {
        $this->idMasa = $idMasa;
    }

    public function getNombreMasa()
    {
        return $this->nombreMasa;
    }

    public function setNombreMasa($masa)
    {
        $this->nombreMasa = $masa;
    }

    public function getNumIng()
    {
        return $this->numIng;
    }

    public function setNumIng($numIng)
    {
        $this->numIng = $numIng;
    }

    public function getIdsIngredientes()
    {
        return $this->idsIngredientes;
    }

    public function setIdsIngredientes($idsIngredientes)
    {
        $this->idsIngredientes = $idsIngredientes;
        $this->setNumIng(count(explode(",", $idsIngredientes)));

        $nombreIngredientes = "";

        foreach (explode(",", $idsIngredientes) as $ing)
            $nombreIngredientes .= getNombreIngrediente($ing) . ", ";

        $this->setNumIng(count(explode(",", $idsIngredientes)));
        $this->setNombresIngredientes(rtrim($nombreIngredientes, ', '));
    }

    public function getNombresIngredientes()
    {
        return $this->nombresIngredientes;
    }

    public function setNombresIngredientes($nombresIngredientes)
    {
        $this->nombresIngredientes = $nombresIngredientes;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    public function getFechayhora()
    {
        return $this->fechayhora;
    }

    public function setFechayhora($fechayhora)
    {
        $this->fechayhora = $fechayhora;
    }

    public function getServido()
    {
        return $this->servido;
    }

    public function setServido($servido)
    {
        $this->servido = $servido;
    }

    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    }

}