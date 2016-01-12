<?php

namespace Shop\Tests\Discount;

use Shop\Discount\MinimumPurchaseAmountCoupon;
use Shop\Discount\ValueCoupon;

class MinimumPurchaseAmountCouponTest extends CouponTest
{
    public function testApplyDiscount()
    {
        $coupon = $this->createCoupon();
        $order = $this->createOrder(10000);

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(9000), $coupon->applyDiscount($order));
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testMinimumPurchaseAmountIsRequiredToApplyDiscount()
    {
        $this->createCoupon()->applyDiscount($this->createOrder(3000));
    }

    private function createOrder($totalAmount)
    {
        $totalAmount = self::money($totalAmount);

        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->atLeastOnce())->method('getTotalAmount')->willReturn($totalAmount);

        return $order;
    }

    private function createCoupon()
    {
        return new MinimumPurchaseAmountCoupon(
            new ValueCoupon('ABCDE', self::money(1000)),
            self::money(6000)
        );
    }
}
