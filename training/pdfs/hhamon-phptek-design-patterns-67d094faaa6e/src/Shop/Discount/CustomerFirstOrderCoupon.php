<?php

namespace Shop\Discount;

use Shop\OrderableInterface;

class CustomerFirstOrderCoupon extends CouponDecorator
{
    public function applyDiscount(OrderableInterface $order)
    {
        $customer = $order->getCustomer();
        if ($customer->hasPastOrders()) {
            throw $this->createCouponException('Customer already has past orders.');
        }

        return $this->coupon->applyDiscount($order);
    }
}
