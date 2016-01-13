<?php

namespace Shop\Tests;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Shop\Combo;
use Shop\DigitalProduct;
use Shop\HardProduct;
use Shop\Weight;

class ComboTest extends \PHPUnit_Framework_TestCase
{
    /** @expectedException \LogicException */
    public function testCreateInvalidCombo()
    {
        new Combo('superpack', [
            new DigitalProduct('foobar', self::price(1200)),
        ]);
    }

    public function testCreateFixedPriceCombo()
    {
        $products[] = new DigitalProduct('A', self::price(1200));
        $products[] = new DigitalProduct('B', self::price(1000));

        $combo = new Combo('superpack', $products, self::price(1600));

        $this->assertSame('superpack', $combo->getName());
        $this->assertEquals(self::price(1600), $combo->getPrice());
        $this->assertEquals(self::weight(0), $combo->getWeight());
    }

    public function testCreateDynamicPriceCombo()
    {
        $products[] = new HardProduct('A', self::price(1200), self::weight(1300));
        $products[] = new HardProduct('B', self::price(1000), self::weight(1200));

        $combo = new Combo('superpack', $products);

        $this->assertSame('superpack', $combo->getName());
        $this->assertEquals(self::price(2200), $combo->getPrice());
        $this->assertEquals(self::weight(2500), $combo->getWeight());
    }

    private static function price($amount)
    {
        return new Money($amount, new Currency('EUR'));
    }

    private static function weight($weight)
    {
        return new Weight($weight);
    }
}
