<?php

namespace Pizza;

interface IngredientInterface
{
    /**
     * Returns the list of toppings on the pizza.
     *
     * @return array
     */
    public function getToppings();

    /**
     * Returns the price of the ingredient.
     *
     * @return \SebastianBergmann\Money\Money
     */
    public function getPrice();
} 
