<?php

namespace Shop;

use SebastianBergmann\Money\Money;

class Combo extends Product
{
    /**
     * An array of products.
     *
     * @var ProductInterface[]
     */
    private $products;

    /**
     * 
     * @param       $name
     * @param array $products
     * @param Money $price
     */
    public function __construct($name, array $products, Money $price = null)
    {
        $this->setProducts($products);

        parent::__construct($name, $price ?: $this->totalPrice(), $this->totalWeight()); 
    }

    /**
     * Returns the combo's total weight.
     *
     * @return Weight
     */
    private function totalWeight()
    {
        $total = $this->getWeightAt(0);
        for ($i = 1; $i < count($this->products); $i++) {
            $total = $total->add($this->getWeightAt($i));
        }

        return $total;
    }

    private function getWeightAt($index)
    {
        return $this->get($index)->getWeight();
    }
    
    /**
     * Returns the combo's total price.
     *
     * @return Money
     */
    private function totalPrice()
    {
        $total = $this->getPriceAt(0);
        for ($i = 1; $i < count($this->products); $i++) {
            $total = $total->add($this->getPriceAt($i));
        }

        return $total;
    }

    private function getPriceAt($index)
    {
        return $this->get($index)->getPrice();
    }

    private function get($index)
    {
        return $this->products[$index];
    }

    private function setProducts(array $products)
    {
        if (count($products) < 2) {
            throw new \LogicException('A combo must combine at least two items.');
        }

        foreach ($products as $product) {
            $this->add($product);
        }
    }

    private function add(ProductInterface $product)
    {
        $this->products[] = $product;
    }
} 
