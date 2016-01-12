<?php

namespace Pizza\Topping;

use Pizza\IngredientInterface;
use Pizza\ToppingDecorator;

class Mozzarella extends ToppingDecorator
{
    public function __construct(IngredientInterface $ingredient)
    {
        parent::__construct($ingredient, self::createPrice(70));
    }

    protected function getName()
    {
        return 'mozzarella';
    }
} 
