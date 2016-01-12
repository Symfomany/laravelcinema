<?php

namespace Pizza;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

abstract class ToppingDecorator implements IngredientInterface
{
    protected $ingredient;
    private $price;

    /**
     * Constructor.
     *
     * @param IngredientInterface $ingredient The ingredient to be decorated
     * @param Money               $price      The ingredient's price
     */
    public function __construct(IngredientInterface $ingredient, Money $price)
    {
        $this->ingredient = $ingredient;
        $this->price = $price;
    }

    /**
     * Returns the topping name.
     *
     * @return string
     */
    abstract protected function getName();

    /**
     * Creates a Money instance.
     *
     * @param  int $price The price in cents
     * @return Money
     */
    protected static function createPrice($price)
    {
        return new Money((int) $price, new Currency('EUR'));
    }

    /**
     * Returns the topping total price.
     *
     * @return Money
     */
    public function getPrice()
    {
        return $this->price->add($this->ingredient->getPrice());
    }

    /**
     * Returns the list of all toppings.
     *
     * @return array
     */
    public function getToppings()
    {
        $toppings   = $this->ingredient->getToppings();
        $toppings[] = $this->getName();

        return $toppings;
    }
} 
