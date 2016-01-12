<?php

namespace Shop;

use SebastianBergmann\Money\Money;

interface ProductInterface
{
    /**
     * Returns the name of the product.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the unit price of the product.
     *
     * @return Money
     */
    public function getPrice();

    /**
     * Returns the weight of the product.
     *
     * @return Weight
     */
    public function getWeight();
}
