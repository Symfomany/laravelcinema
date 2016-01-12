<?php

namespace Shop\Tests;

use Shop\OrderItem;
use Shop\Tests\Discount\CouponTest;

class OrderItemTest extends CouponTest
{
    public function testCreateOrderItem()
    {
        $item = new OrderItem('Product A', 2, self::money(1000));

        $this->assertSame(2, $item->getQuantity());
        $this->assertNull($item->getCustomer());
        $this->assertEquals(self::money(2000), $item->getTotalAmount());
    }

    /**
     * @dataProvider provideInvalidQuantity
     * @expectedException \Shop\OrderException
     */
    public function testCreateInvalidOrderItem($quantity)
    {
        new OrderItem('Product A', $quantity, self::money(1000));
    }

    public function provideInvalidQuantity()
    {
        return [
            [ 0 ],
            [ -10 ],
            [ true ],
            [ false ],
            [ 0.50 ],
            [ -0.30 ],
            [ 1.20 ],
        ];
    }
}
