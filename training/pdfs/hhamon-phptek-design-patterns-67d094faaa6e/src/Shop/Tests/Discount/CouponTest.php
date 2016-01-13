<?php

namespace Shop\Tests\Discount;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Shop\Customer;
use Shop\Discount\LimitedLifetimeCoupon;
use Shop\Discount\MinimumPurchaseAmountCoupon;
use Shop\Discount\ValueCoupon;
use Shop\LoyaltyCard;
use Shop\Order;
use Shop\OrderItem;

abstract class CouponTest extends \PHPUnit_Framework_TestCase
{
    public function testCombineCouponRestrictions()
    {
        $loyaltyCard = new LoyaltyCard('2972822', 'Gold', self::money(1200));
        $customer = new Customer('foo@bar.com', $loyaltyCard);
        $order = new Order($customer, [
            // Total amount is 120 EUR
            new OrderItem('Product A', 2, self::money(2500)),
            new OrderItem('Product B', 1, self::money(7000)),
        ]);

        $coupon = new MinimumPurchaseAmountCoupon(
            // Coupon is limited in time
            new LimitedLifetimeCoupon(
                // Discount value of 10 EUR
                new ValueCoupon('ABCDE', self::money(1000)),
                'yesterday',
                '+30 days'
            ),
            // Minimum purchase amount of 60 EUR
            self::money(6000)
        );

        $this->assertSame('ABCDE', $coupon->getCode());
        $this->assertEquals(self::money(11000), $coupon->applyDiscount($order));
    }

    protected static function money($amount)
    {
        return new Money($amount, new Currency('EUR'));
    }
}
