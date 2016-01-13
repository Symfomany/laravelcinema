<?php

namespace Shop;

final class Weight
{
    /**
     * The weight value expressed in gramms.
     *
     * @var int
     */
    private $value;

    /**
     * Constructor.
     *
     * @param int $weight The weight value expressed in gramms.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($weight)
    {
        if (!is_int($weight) || $weight < 0) {
            throw new \InvalidArgumentException('$weight must be a valid positive integer.');
        }

        $this->value = $weight;
    }

    public function add(Weight $weight)
    {
        return $this->createWeight($this->value + $weight->getValue());
    }

    public function subtract(Weight $weight)
    {
        return $this->createWeight($this->value - $weight->getValue());
    }

    public function multiply($times)
    {
        return $this->createWeight($this->value * $times);
    }

    public function getValue()
    {
        return $this->value;
    }

    private function createWeight($weight)
    {
        return new static($weight);
    }
}
