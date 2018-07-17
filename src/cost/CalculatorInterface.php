<?php

namespace koind\cost;

use koind\CartItem;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float;
}