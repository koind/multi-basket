<?php

namespace Koind\cost;

use Koind\CartItem;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float;
}