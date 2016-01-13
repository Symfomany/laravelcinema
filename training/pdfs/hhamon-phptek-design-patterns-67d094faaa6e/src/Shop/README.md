The Shop Component
==================

The `Shop` component implement two design patterns: Composite and Decorator. The
Composite pattern implementation is represented by the `Shop\Combo` class to
combine on sale products as combos instead of single products. The Decorator
pattern is implemented by the `Discount` subpackage. The coupon and restrictions
rules to reduce the total amount of an order object are implemented as
decorators.

Combo Products Usage
--------------------

Combining both `HardProduct`, `DigitalProduct` and `Combo` products into one
single collection of type `Combo`. Thanks to the Composite `Combo` collection,
the webshop can sell products combos as if they were single products.

    :::php
    <?php
    
    $products = [
        new HardProduct('Digital Camera', new Money(78900, $currency), new Weight(855)),
        new HardProduct('Camera Bag', new Money(3900, $currency), new Weight(220)),
        new HardProduct('Memory Card 128 Gb', new Money(7900, $currency), new Weight(42)),
    ];
    
    $combo = new Combo('Digital Camera Combo Pack + Tripod', [
        new HardProduct('Lightweight Tripod', new Money(2690, $currency), new Weight(570)),
        new Combo('Digital Camera & Bag', $products, new Money(83900, $currency)),
    ]);
    
    echo 'Name:   ', $combo->getName() ,"\n";
    echo 'Weight: ', $combo->getWeight()->getValue() ,"\n";
    echo 'Price:  ', $combo->getPrice()->getAmount() ,"\n";

Discounting an Order
--------------------

To discount the total price of an `Order` object, the system uses decorators.
Each order decorator is responsible for checking that the restriction rule on
the coupon is met in order to apply the discount. Thanks to the decorators
architecture, the number of restriction rules applicable to one single rate or
value coupon is unlimited.

    :::php
    <?php
    
    use Shop\Discount;
    
    // Create the special coupon
    $coupon = new Discount\ValueCoupon('3s2h7pd65s', new EUR(2000));
    $coupon = new Discount\LimitedLifetimeCoupon($coupon, 'now', '+60 days');
    $coupon = new Discount\MinimumPurchaseAmountCoupon($coupon, new EUR(17000));
    $coupon = new Discount\CustomerFirstOrderCoupon($coupon);
    
    // Create the order instance
    $totalAmount = new SebastianBergmann\Money\EUR(20000);
    $customer = new Shop\Customer('jsmith@example.com');
    $order = new Shop\Order($customer, $totalAmount);
    
    // Apply discount coupon on the order
    $discountedAmount = $coupon->applyDiscount($order);
    
    // Display the new discounted total amount
    $formatter = new SebastianBergmann\Money\IntlFormatter('fr_FR');
    echo sprintf("Original Price: %s\n", $formatter->format($totalAmount));
    echo sprintf("Discount Price: %s\n", $formatter->format($discountedAmount));
