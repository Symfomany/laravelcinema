<?php

namespace Pizza\Topping;

use Pizza\IngredientInterface;
use Pizza\ToppingDecorator;

class Mushrooms extends ToppingDecorator
{
    public function __construct(IngredientInterface $ingredient)
    {
        parent::__construct($ingredient, self::createPrice(45));
    }

    protected function getName()
    {
        return 'mushrooms';
    }
}
