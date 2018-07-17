<?php

namespace koind\cost;

use koind\CartItem;

class SimpleCost implements CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}