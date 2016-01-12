<?php

namespace Shop;

use SebastianBergmann\Money\Money;

abstract class Product implements ProductInterface
{
    protected $name;
    protected $price;
    protected $weight;

    public function __construct($name, Money $price, Weight $weight)
    {
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}
