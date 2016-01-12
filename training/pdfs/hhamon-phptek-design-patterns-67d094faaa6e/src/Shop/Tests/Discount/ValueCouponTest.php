<?php

namespace Shop\Tests\Discount;

use Shop\Discount\ValueCoupon;

class ValueCouponTest extends CouponTest
{
    public function testApplyCoupon()
    {
        $coupon = new ValueCoupon('ABCDE', self::money(3000));
        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->once())->method('getTotalAmount')->willReturn(self::money(10000));

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(7000), $coupon->applyDiscount($order));
    }
}
