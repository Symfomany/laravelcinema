<?php

namespace Shop\Discount;

abstract class CouponDecorator implements CouponInterface
{
    protected $coupon;

    public function __construct(CouponInterface $coupon)
    {
        $this->coupon = $coupon;
    }

    public function getCode()
    {
        return $this->coupon->getCode();
    }

    protected function createCouponException($message, \Exception $previous = null)
    {
        return new CouponException($message, 0, $previous);
    }
}
