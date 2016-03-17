<?php

require_once "modelo/gestionIngredientes.php";

class Pizza
{

    private $idPizza;
    private $nombre;
    private $descripcion;
    private $numIngredientes;
    private $nombresIngredientes;
    private $idsIngredientes;
    private $imagen;
    private $stock;

    public function getIdPizza()
    {
        return $this->idPizza;
    }

    public function setIdPizza($idPizza)
    {
        $this->idPizza = $idPizza;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getIdsIngredientes()
    {
        return $this->idsIngredientes;
    }

    public function setIdsIngredientes($idsIngredientes)
    {
        $this->idsIngredientes = $idsIngredientes;
        $this->setNumIngredientes(count(explode(",", $idsIngredientes)));

        $nombreIngredientes = "";

        foreach (explode(",", $idsIngredientes) as $ing)
            $nombreIngredientes .= getNombreIngrediente($ing) . ", ";

        $this->setNombresIngredientes(rtrim($nombreIngredientes, ', '));
    }

    public function getNumIngredientes()
    {
        return $this->numIngredientes;
    }

    public function setNumIngredientes($numIngredientes)
    {
        $this->numIngredientes = $numIngredientes;
    }

    public function getNombresIngredientes()
    {
        return $this->nombresIngredientes;
    }

    public function setNombresIngredientes($nombresIngredientes)
    {
        $this->nombresIngredientes = $nombresIngredientes;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

}