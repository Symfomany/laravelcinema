<?php

namespace Navigation\Tests;

use Navigation\Item;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testSingleItem()
    {
        $item = new Item('Foo', '/foo');

        $this->assertSame('Foo', $item->getLabel());
        $this->assertSame('/foo', $item->getLink());
        $this->assertEmpty($item->getItems());
        $this->assertCount(0, $item->getItems());
        $this->assertFalse($item->hasItems());
    }

    public function testCompositeItem()
    {
        $item = new Item('Foo', '/foo', [
            new Item('Bar', '/bar'),
            new Item('Baz'),
        ]);

        $this->assertSame('Foo', $item->getLabel());
        $this->assertSame('/foo', $item->getLink());
        $this->assertCount(2, $item->getItems());
        $this->assertTrue($item->hasItems());
    }
}
