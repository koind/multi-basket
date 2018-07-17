<?php

namespace koind\cost;

use koind\CartItem;

class DummyCost implements CalculatorInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        return $this->value;
    }
}