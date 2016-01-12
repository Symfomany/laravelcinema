<?php

namespace Shop;

use SebastianBergmann\Money\Money;

interface OrderableInterface
{
    /**
     * Returns the ordered quantity.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Returns a Customer object.
     *
     * @return Customer
     */
    public function getCustomer();

    /**
     * Returns the total ordered amount.
     *
     * @return Money
     */
    public function getTotalAmount();
} 
