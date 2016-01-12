<?php

namespace Shop\Tests;

use Shop\Weight;

class WeightTest extends \PHPUnit_Framework_TestCase
{
    /** @expectedException \InvalidArgumentException */
    public function testCreateInvalidWeight()
    {
        new Weight(-10);
    }

    public function testGetValue()
    {
        $weight = new Weight(10);

        $this->assertSame(10, $weight->getValue());
    }

    public function testAddWeight()
    {
        $weight1 = new Weight(10);
        $weight2 = new Weight(20);

        $weight3 = $weight1->add($weight2);

        $this->assertSame(10, $weight1->getValue());
        $this->assertSame(20, $weight2->getValue());
        $this->assertSame(30, $weight3->getValue());

        $this->assertNotSame($weight3, $weight1);
        $this->assertNotSame($weight3, $weight2);
    }

    public function testSubtractWeight()
    {
        $weight1 = new Weight(10);
        $weight2 = new Weight(20);

        $weight3 = $weight2->subtract($weight1);

        $this->assertSame(10, $weight1->getValue());
        $this->assertSame(20, $weight2->getValue());
        $this->assertSame(10, $weight3->getValue());

        $this->assertNotSame($weight3, $weight1);
        $this->assertNotSame($weight3, $weight2);
        $this->assertEquals($weight3, $weight1);
    }

    public function testMultiplyWeight()
    {
        $weight1 = new Weight(10);
        $weight2 = $weight1->multiply(5);

        $this->assertSame(50, $weight2->getValue());
        $this->assertNotSame($weight2, $weight1);
    }
}
