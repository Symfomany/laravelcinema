The Pizza Component
===================

The Pizza example is a great implementation of the Decorator pattern. It allows
to create as many different styles of pizzas as your imagination can produce.
Any combination of pizza toppings is possible with a decorator. In this example,
we want to know what the unit cost of to cook a new pizza depending on how many
toppings we put on it.

Usage
-----

Each topping ingredient (ham, cheese, mushrooms...) is defined as a decorator to
decorate the original Pizza concrete instance.

    :::php
    <?php
    
    use Pizza\Pizza;
    use Pizza\Topping\Mozzarella;
    use Pizza\Topping\Ham;
    use Pizza\Topping\Egg;
    use Pizza\Topping\Mushrooms;
    use SebastianBergmann\Money\IntlFormatter;
    
    $pizza = new Pizza(Pizza::TOMATO);
    $pizza = new Egg(new Egg(new Mushrooms(new Mozzarella(new Ham($pizza)))));
    
    $formatter = new IntlFormatter('fr_FR');
    echo sprintf("Toppings: %s.\n", implode(', ', $pizza->getToppings()));
    echo sprintf("Price: %s\n", $formatter->format($pizza->getPrice()));

