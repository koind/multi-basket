<?php

namespace koind\cost;

use koind\CartItem;

class FourCost implements CalculatorInterface
{
    private $next;

    public function __construct(CalculatorInterface $next)
    {
        $this->next = $next;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $cost = $this->next->getCost($items);

        $k = 0;
        foreach ($items as $item) {
            if ($k % 4 === 3) {
                $cost -= $item->getCost() - 1;
            }
            $k++;
        }
        return $cost;
    }
}