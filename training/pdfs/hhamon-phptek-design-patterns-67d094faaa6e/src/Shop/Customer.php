<?php

namespace Shop;

class Customer
{
    private $email;
    private $loyaltyCard;
    private $pastOrders;

    public function __construct($email, LoyaltyCard $loyaltyCard, $pastOrders = false)
    {
        $this->email = $email;
        $this->loyaltyCard = $loyaltyCard;
        $this->pastOrders = $pastOrders;
    }

    public function hasPastOrders()
    {
        return $this->pastOrders;
    }

    public function getLoyaltyCardNumber()
    {
        return $this->loyaltyCard->getNumber();
    }

    public function getMembershipStatus()
    {
        return $this->loyaltyCard->getStatus();
    }

    public function getCashbackBalance()
    {
        return $this->loyaltyCard->getCashbackBalance();
    }
}
