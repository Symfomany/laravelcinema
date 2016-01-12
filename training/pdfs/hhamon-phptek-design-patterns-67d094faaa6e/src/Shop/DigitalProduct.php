<?php

namespace Shop;

use SebastianBergmann\Money\Money;

class DigitalProduct extends Product
{
    public function __construct($name, Money $price)
    {
        parent::__construct($name, $price, new Weight(0));
    }
} 
