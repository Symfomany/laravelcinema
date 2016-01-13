<?php

namespace Shop\Tests;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Shop\Customer;
use Shop\LoyaltyCard;
use Shop\NoLoyaltyCard;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    const PAST_ORDERS = false;

    public function testCreateCustomerWithoutMembershipCard()
    {
        $customer = new Customer(
            'foo@bar.com',
            new NoLoyaltyCard(),
            self::PAST_ORDERS
        );

        $this->assertNull($customer->getLoyaltyCardNumber());
        $this->assertNull($customer->getMembershipStatus());
        $this->assertFalse($customer->hasPastOrders());
        $this->assertEquals(self::money(0), $customer->getCashbackBalance());
    }

    public function testCreateCustomer()
    {
        $customer = new Customer(
            'foo@bar.com',
            new LoyaltyCard('20038312', 'gold', self::money(2000)),
            self::PAST_ORDERS
        );

        $this->assertSame('20038312', $customer->getLoyaltyCardNumber());
        $this->assertSame('gold', $customer->getMembershipStatus());
        $this->assertFalse($customer->hasPastOrders());
        $this->assertEquals(self::money(2000), $customer->getCashbackBalance());
    }

    private static function money($amount)
    {
        return new Money($amount, new Currency('EUR'));
    }
}
