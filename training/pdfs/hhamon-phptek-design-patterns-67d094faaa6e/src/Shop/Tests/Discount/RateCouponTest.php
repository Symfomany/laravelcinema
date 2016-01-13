<?php

namespace Shop\Tests\Discount;

use Shop\Discount\RateCoupon;

class RateCouponTest extends CouponTest
{
    public function testApplyCoupon()
    {
        $coupon = new RateCoupon('ABCDE', .50);
        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->once())->method('getTotalAmount')->willReturn(self::money(10000));

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(5000), $coupon->applyDiscount($order));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider provideInvalidRate
     */
    public function testInvalidRateValue($invalidRate)
    {
        new RateCoupon('ABCDE', $invalidRate);
    }

    public function provideInvalidRate()
    {
        return [
            [10],
            [0.0],
            [1.1],
        ];
    }
}
