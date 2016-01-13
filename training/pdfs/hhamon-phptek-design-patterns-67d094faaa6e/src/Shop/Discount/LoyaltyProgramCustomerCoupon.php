<?php

namespace Shop\Discount;

use Shop\OrderableInterface;

class LoyaltyProgramCustomerCoupon extends CouponDecorator
{
    public function applyDiscount(OrderableInterface $order)
    {
        $customer = $order->getCustomer();
        if (!$customer->getLoyaltyCardNumber()) {
            throw $this->createCouponException('Coupon is reserved to loyal customers.');
        }

        return $this->coupon->applyDiscount($order);
    }
}
