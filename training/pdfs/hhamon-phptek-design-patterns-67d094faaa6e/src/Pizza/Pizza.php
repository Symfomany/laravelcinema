<?php

namespace Pizza;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class Pizza implements IngredientInterface
{
    const TOMATO = 'tomato';
    const CREAM = 'cream';

    private $base;

    public function __construct($base)
    {
        $this->base = $base;
    }

    public function getToppings()
    {
        return [$this->base];
    }

    public function getPrice()
    {
        return new Money(200, new Currency('EUR'));
    }
}
