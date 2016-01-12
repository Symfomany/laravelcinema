<?php

namespace Shop\Discount;

use Shop\OrderableInterface;

class RateCoupon implements CouponInterface
{
    private $code;
    private $rate;

    public function __construct($code, $rate)
    {
        if (!is_float($rate)) {
            throw new \InvalidArgumentException('Discount rate must be a valid float.');
        }

        if ($rate <= 0 || $rate > 1) {
            throw new \InvalidArgumentException('Discount rate must be in range ]0, 1].');
        }

        $this->code = $code;
        $this->rate = $rate;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function applyDiscount(OrderableInterface $order)
    {
        $amount = $order->getTotalAmount();

        return $amount->subtract($amount->multiply($this->rate));
    }
} 
