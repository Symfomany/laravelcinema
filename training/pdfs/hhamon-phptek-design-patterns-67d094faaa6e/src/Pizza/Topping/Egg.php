<?php

namespace Pizza\Topping;

use Pizza\IngredientInterface;
use Pizza\ToppingDecorator;

class Egg extends ToppingDecorator
{
    public function __construct(IngredientInterface $ingredient)
    {
        parent::__construct($ingredient, self::createPrice(60));
    }

    protected function getName()
    {
        return 'egg';
    }
} 
