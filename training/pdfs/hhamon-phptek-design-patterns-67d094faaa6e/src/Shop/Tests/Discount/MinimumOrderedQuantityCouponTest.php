<?php

namespace Shop\Tests\Discount;

use Shop\Discount\MinimumOrderedQuantityCoupon;
use Shop\Discount\ValueCoupon;

class MinimumOrderedQuantityCouponTest extends CouponTest
{
    public function testApplyDiscount()
    {
        $order = $this->createOrder(10);
        $order->expects($this->atLeastOnce())->method('getTotalAmount')->willReturn(self::money(20000));

        $coupon = $this->createCoupon();

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(19000), $coupon->applyDiscount($order));
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testMinimumQuantityIsRequiredToApplyDiscount()
    {
        $this->createCoupon()->applyDiscount($this->createOrder(2));
    }

    /**
     * @dataProvider provideInvalidMininumQuantity
     * @expectedException \InvalidArgumentException
     */
    public function testCreateInvalidCoupon($minQuantity)
    {
        new MinimumOrderedQuantityCoupon(new ValueCoupon('ABCDE', self::money(1000)), $minQuantity);
    }

    public function provideInvalidMininumQuantity()
    {
        return [
            [0],
            [-10],
            [true],
            [false],
            [0.50],
            [-0.30],
            [1.20],
        ];
    }

    private function createOrder($quantity)
    {
        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->atLeastOnce())->method('getQuantity')->willReturn($quantity);

        return $order;
    }

    private function createCoupon()
    {
        return new MinimumOrderedQuantityCoupon(new ValueCoupon('ABCDE', self::money(1000)), 3);
    }
}
