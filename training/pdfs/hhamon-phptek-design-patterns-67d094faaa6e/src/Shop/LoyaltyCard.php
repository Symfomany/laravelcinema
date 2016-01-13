<?php

namespace Shop;

use SebastianBergmann\Money\Money;

class LoyaltyCard
{
    private $number;
    private $status;
    private $cashbackBalance;

    public function __construct($number, $status, Money $cashbackBalance)
    {
        $this->number = $number;
        $this->status = $status;
        $this->cashbackBalance = $cashbackBalance;
    }

    final public function getCashbackBalance()
    {
        return $this->cashbackBalance;
    }

    final public function getNumber()
    {
        return $this->number;
    }

    final public function getStatus()
    {
        return $this->status;
    }
}
