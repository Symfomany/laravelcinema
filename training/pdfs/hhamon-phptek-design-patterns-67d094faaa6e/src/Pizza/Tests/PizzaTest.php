<?php

namespace Pizza\Tests;

use Pizza\Pizza;
use Pizza\Topping\Egg;
use Pizza\Topping\Ham;
use Pizza\Topping\Mozzarella;
use Pizza\Topping\Mushrooms;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class PizzaTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateBarePizza()
    {
        $pizza = new Pizza(Pizza::TOMATO);

        $this->assertSame([ Pizza::TOMATO ], $pizza->getToppings());
        $this->assertEquals(self::price(200), $pizza->getPrice());
    }

    /** @dataProvider provideBaseTopping */
    public function testCreatePizzaWithToppings($base)
    {
        $pizza = new Egg(new Egg(new Mushrooms(new Mozzarella(new Ham(new Pizza($base))))));

        $toppings = [ $base, 'ham', 'mozzarella', 'mushrooms', 'egg', 'egg' ];

        $this->assertSame($toppings, $pizza->getToppings());
        $this->assertEquals(self::price(555), $pizza->getPrice());
    }

    public function provideBaseTopping()
    {
        return [
            [ Pizza::TOMATO ],
            [ Pizza::CREAM ],
            [ 'chocolate' ],
        ];
    }

    private static function price($amount)
    {
        return new Money($amount, new Currency('EUR'));
    }
}
