<?php

namespace koind\cost;

use koind\CartItem;

class BigCost implements CalculatorInterface
{
    private $next;
    private $limit;
    private $percent;

    public function __construct(CalculatorInterface $next, int $limit, float $percent)
    {
        $this->next = $next;
        $this->limit = $limit;
        $this->percent = $percent;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $cost = $this->next->getCost($items);
        if ($cost > $this->limit) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}