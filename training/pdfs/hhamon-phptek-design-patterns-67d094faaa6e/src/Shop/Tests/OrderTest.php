<?php

namespace Shop\Tests;

use Shop\Customer;
use Shop\LoyaltyCard;
use Shop\Order;
use Shop\OrderItem;
use Shop\Tests\Discount\CouponTest;

class OrderTest extends CouponTest
{
    public function testCreateOrder()
    {
        $loyaltyCard = new LoyaltyCard('2972822', 'Gold', self::money(1200));
        $customer = new Customer('foo@bar.com', $loyaltyCard);
        $order = new Order($customer, [
            // Total amount is 120 EUR
            new OrderItem('Product A', 2, self::money(2500)),
            new OrderItem('Product B', 1, self::money(7000)),
        ]);

        $this->assertSame(3, $order->getQuantity());
        $this->assertEquals(self::money(12000), $order->getTotalAmount());
        $this->assertSame($customer, $order->getCustomer());
        $this->assertNull($order->getInvoice());
        $this->assertNull($order->getTickets());
        $this->assertNull($order->getReference());
        $this->assertNull($order->paid(1230423));
        $this->assertNull($order->processed());
        $this->assertNull($order->cancelled());
        $this->assertNull($order->refunded());
        $this->assertNull($order->attachInvoice($this->createInvoice()));
        $this->assertNull($order->attachTickets($this->createTickets()));
    }

    private function createInvoice()
    {
        return $this->getMock('Shop\Invoicing\Invoice');
    }

    private function createTickets()
    {
        return $this->getMock('Shop\Ticketing\Tickets');
    }
}
