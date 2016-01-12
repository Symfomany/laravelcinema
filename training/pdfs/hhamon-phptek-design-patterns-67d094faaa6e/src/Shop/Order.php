<?php

namespace Shop;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Shop\Invoicing\Invoice;
use Shop\Ticketing\Tickets;

class Order implements OrderableInterface
{
    private $items;
    private $currency;
    private $customer;

    public function __construct(Customer $customer, array $items, Currency $currency = null)
    {
        $this->addItems($items);
        $this->currency = $currency ?: new Currency('EUR');
        $this->customer = $customer;
    }

    /** @return Invoice */
    public function getInvoice()
    {
        
    }

    /** @return Tickets */
    public function getTickets()
    {
        
    }

    /** @return string */
    public function getReference()
    {
        
    }

    public function paid($transaction)
    {
        
    }
    
    public function processed()
    {
        
    }

    public function cancelled()
    {

    }

    public function refunded()
    {

    }

    public function attachInvoice(Invoice $invoice)
    {
    }

    public function attachTickets(Tickets $tickets)
    {
        
    }

    private function addItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    private function addItem(OrderItem $item)
    {
        $this->items[] = $item;
    }

    public function getTotalAmount()
    {
        $total = new Money(0, $this->currency);
        foreach ($this->items as $item) {
            $total = $total->add($item->getTotalAmount());
        }

        return $total;
    }

    /**
     * Returns the ordered quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        $quantity = 0;
        foreach ($this->items as $item) {
            $quantity += $item->getQuantity();
        }

        return $quantity;
    }

    /**
     * Returns a Customer object.
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
} 
