<?php

namespace Shop\Discount;

use Shop\OrderableInterface;

class LimitedLifetimeCoupon extends CouponDecorator
{
    private $startAt;
    private $expiresAt;

    public function __construct(CouponInterface $coupon, $startAt, $expiresAt)
    {
        if (!$startAt instanceof \DateTime) {
            $startAt = new \DateTime($startAt);
        }

        if (!$expiresAt instanceof \DateTime) {
            $expiresAt = new \DateTime($expiresAt);
        }

        if ($startAt > $expiresAt) {
            throw new \InvalidArgumentException('$startAt cannot be greater than $expiresAt.');
        }

        parent::__construct($coupon);

        $this->startAt = $startAt;
        $this->expiresAt = $expiresAt;
    }

    public function applyDiscount(OrderableInterface $order)
    {
        $now = new \DateTime('now');
        if ($this->startAt > $now) {
            throw $this->createCouponException(sprintf(
                'Coupon is usable from %s.',
                $this->startAt->format('Y-m-d H:i:s')
            ));
        }

        if ($now > $this->expiresAt) {
            throw $this->createCouponException(sprintf(
                'Coupon was valid until %s.',
                $this->expiresAt->format('Y-m-d H:i:s')
            ));
        }

        return $this->coupon->applyDiscount($order);
    }
}
