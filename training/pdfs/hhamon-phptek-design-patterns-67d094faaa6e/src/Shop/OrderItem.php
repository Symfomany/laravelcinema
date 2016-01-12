<?php

namespace Shop;

use SebastianBergmann\Money\Money;

class OrderItem implements OrderableInterface
{
    private $designation;
    private $quantity;
    private $unitPrice;

    public function __construct($designation, $quantity, Money $unitPrice)
    {
        $this->designation = $designation;
        $this->unitPrice = $unitPrice;
        $this->setQuantity($quantity);
    }

    private function setQuantity($quantity)
    {
        if (!is_int($quantity)) {
            throw new OrderException('$quantity must be a valid integer.');
        }

        if ($quantity < 1) {
            throw new OrderException('$quantity must be greater or equal than 1.');
        }

        $this->quantity = $quantity;
    }

    public function getTotalAmount()
    {
        return $this->unitPrice->multiply($this->quantity);
    }

    /**
     * Returns the ordered quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Returns a Customer object.
     *
     * @return Customer
     */
    public function getCustomer()
    {
        // TODO: Implement getCustomer() method.
    }
} 
