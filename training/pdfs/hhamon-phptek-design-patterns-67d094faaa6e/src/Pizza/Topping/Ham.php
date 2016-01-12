<?php

namespace Pizza\Topping;

use Pizza\IngredientInterface;
use Pizza\ToppingDecorator;

class Ham extends ToppingDecorator
{
    public function __construct(IngredientInterface $ingredient)
    {
        parent::__construct($ingredient, self::createPrice(120));
    }

    protected function getName()
    {
        return 'ham';
    }
} 
