<?php

namespace Shop\Discount;

use SebastianBergmann\Money\Money;
use Shop\OrderableInterface;

class ValueCoupon implements CouponInterface
{
    private $code;
    private $discount;

    public function __construct($code, Money $discount)
    {
        $this->code = $code;
        $this->discount = $discount;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function applyDiscount(OrderableInterface $order)
    {
        $amount = $order->getTotalAmount();

        return $amount->subtract($this->discount);
    }
} 
