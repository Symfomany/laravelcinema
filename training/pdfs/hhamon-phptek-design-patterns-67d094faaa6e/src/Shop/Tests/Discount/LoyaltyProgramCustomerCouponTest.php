<?php

namespace Shop\Tests\Discount;

use Shop\Discount\LoyaltyProgramCustomerCoupon;
use Shop\Discount\ValueCoupon;

class LoyaltyProgramCustomerCouponTest extends CouponTest
{
    public function testApplyDiscount()
    {
        $order = $this->createOrder('201729832');
        $order->expects($this->atLeastOnce())->method('getTotalAmount')->willReturn(self::money(20000));

        $coupon = $this->createCoupon();

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(19000), $coupon->applyDiscount($order));
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testLoyaltyCardMembershipRequiredToApplyDiscount()
    {
        $this->createCoupon()->applyDiscount($this->createOrder(null));
    }

    private function createOrder($loyaltyCardNumber)
    {
        $customer = $this
            ->getMockBuilder('Shop\Customer')
            ->disableOriginalConstructor()
            ->getMock();

        $customer
            ->expects($this->atLeastOnce())
            ->method('getLoyaltyCardNumber')
            ->willReturn($loyaltyCardNumber);

        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->atLeastOnce())->method('getCustomer')->willReturn($customer);

        return $order;
    }

    private function createCoupon()
    {
        return new LoyaltyProgramCustomerCoupon(new ValueCoupon('ABCDE', self::money(1000)));
    }
}
