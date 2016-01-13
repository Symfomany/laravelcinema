<?php

namespace Shop\Tests\Discount;

use Shop\Discount\CustomerFirstOrderCoupon;
use Shop\Discount\ValueCoupon;

class CustomerFirstOrderCouponTest extends CouponTest
{
    public function testApplyDiscount()
    {
        // false: client does not have passed orders
        $order = $this->createOrder(false);
        $order->expects($this->once())->method('getTotalAmount')->willReturn(self::money(10000));

        $coupon = $this->createCoupon();

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(9000), $coupon->applyDiscount($order));
    }

    /** @expectedException \Shop\Discount\CouponException */
    public function testCustomerHasPassedOrders()
    {
        // true: client has passed orders
        $order = $this->createOrder(true);
        $order->expects($this->never())->method('getTotalAmount');

        $this->createCoupon()->applyDiscount($order);
    }

    private function createOrder($customerHasPastOrders)
    {
        $customer = $this
            ->getMockBuilder('Shop\Customer')
            ->disableOriginalConstructor()
            ->getMock();

        $customer
            ->expects($this->once())
            ->method('hasPastOrders')
            ->willReturn($customerHasPastOrders);

        $order = $this->getMock('Shop\OrderableInterface');
        $order->expects($this->once())->method('getCustomer')->willReturn($customer);

        return $order;
    }

    private function createCoupon()
    {
        return new CustomerFirstOrderCoupon(new ValueCoupon('ABCDE', self::money(1000)));
    }
}
