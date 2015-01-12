<?php

class Product
{
    protected $name;
    protected $price;

    public function __construct($name, $price)
    {
        $this->name    = $name;
        $this->price   = $price;
    }

    public function getName() { return $this->name; }
    public function getPrice() { return sprintf('%01.2f', $this->price); }
}
