<?php

namespace Shop\Discount;

use SebastianBergmann\Money\Money;
use Shop\OrderableInterface;

interface CouponInterface
{
    /**
     * Returns the unique coupon code.
     *
     * @return string
     */
    public function getCode();

    /**
     * Returns the new total amount after the coupon
     * has been applied on the given order.
     *
     * @param OrderableInterface $order The order to discount
     *
     * @throws CouponException When coupon is not applicable
     *
     * @return Money The new order total amount
     */
    public function applyDiscount(OrderableInterface $order);
}
