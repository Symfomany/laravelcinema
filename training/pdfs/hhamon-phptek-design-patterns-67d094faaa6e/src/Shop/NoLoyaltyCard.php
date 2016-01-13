<?php

namespace Shop;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class NoLoyaltyCard extends LoyaltyCard
{
    public function __construct()
    {
        parent::__construct(null, null, new Money(0, new Currency('EUR')));
    }
}
