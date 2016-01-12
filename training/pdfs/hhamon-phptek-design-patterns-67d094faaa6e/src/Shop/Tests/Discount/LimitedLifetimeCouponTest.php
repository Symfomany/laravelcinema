<?php

namespace Shop\Tests\Discount;

use Shop\Discount\LimitedLifetimeCoupon;
use Shop\Discount\ValueCoupon;

class LimitedLifetimeCouponTest extends CouponTest
{
    public function testApplyDiscount()
    {
        $coupon = $this->createCoupon('yesterday', '+30 days');
        $order = $this->createOrder();
        $order->expects($this->once())->method('getTotalAmount')->willReturn(self::money(10000));

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(9000), $coupon->applyDiscount($order));
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testCouponIsNotYetApplicable()
    {
        $coupon = $this->createCoupon('+2 days', '+30 days');
        $order = $this->createOrder();
        $order->expects($this->never())->method('getTotalAmount');

        $coupon->applyDiscount($order);
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testCouponIsNotApplicableAnymore()
    {
        $coupon = $this->createCoupon('2014-01-01', '2014-12-31');
        $order = $this->createOrder();
        $order->expects($this->never())->method('getTotalAmount');

        $coupon->applyDiscount($order);
    }

    /** @expectedException \InvalidArgumentException */
    public function testCreateInvalidCoupon()
    {
        $this->createCoupon('2015-02-20', '2015-02-19');
    }

    private function createOrder()
    {
        $order = $this->getMock('Shop\OrderableInterface');

        return $order;
    }

    private function createCoupon($startDate, $expirationDate)
    {
        return new LimitedLifetimeCoupon(
            new ValueCoupon('ABCDE', self::money(1000)),
            $startDate,
            $expirationDate
        );
    }
}
