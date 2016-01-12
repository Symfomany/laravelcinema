<?php

namespace Shop\Discount;

use Shop\OrderableInterface;

class MinimumOrderedQuantityCoupon extends CouponDecorator
{
    public function __construct(CouponInterface $coupon, $minimumQuantity)
    {
        if (!is_int($minimumQuantity)) {
            throw new \InvalidArgumentException('$quantity must be a valid integer.');
        }

        if ($minimumQuantity < 1) {
            throw new \InvalidArgumentException('$quantity must be at least one.');
        }

        parent::__construct($coupon);

        $this->minimumQuantity = $minimumQuantity;
    }

    public function applyDiscount(OrderableInterface $order)
    {
        $quantity = $order->getQuantity();
        if ($quantity < $this->minimumQuantity) {
            throw $this->createCouponException(sprintf(
                'Minimum quantity of %u is required.',
                $this->minimumQuantity
            ));
        }

        return $this->coupon->applyDiscount($order);
    }
}
