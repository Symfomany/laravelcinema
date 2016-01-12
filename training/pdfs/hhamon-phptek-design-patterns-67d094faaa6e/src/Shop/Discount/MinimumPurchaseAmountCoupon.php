<?php

namespace Shop\Discount;

use SebastianBergmann\Money\Money;
use Shop\OrderableInterface;

class MinimumPurchaseAmountCoupon extends CouponDecorator
{
    private $minimumAmount;

    public function __construct(CouponInterface $coupon, Money $minimumAmount)
    {
        parent::__construct($coupon);

        $this->minimumAmount = $minimumAmount;
    }

    public function applyDiscount(OrderableInterface $order)
    {
        $amount = $order->getTotalAmount();
        if ($amount->lessThan($this->minimumAmount)) {
            throw $this->createCouponException(sprintf(
                'Coupon requires a minimum amount of %u.',
                $this->minimumAmount->getAmount()
            ));
        }

        return $this->coupon->applyDiscount($order);
    }
} 
