<?php

class Ingrediente
{

    private $idIngrediente;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $stock;

    public function getIdIngrediente()
    {
        return $this->idIngrediente;
    }

    public function setIdIngrediente($idIngrediente)
    {
        $this->idIngrediente = $idIngrediente;
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