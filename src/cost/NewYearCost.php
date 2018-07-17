<?php

namespace Koind\cost;

use Koind\CartItem;

class NewYearCost implements CalculatorInterface
{
    private $next;
    private $month;
    private $percent;

    public function __construct(CalculatorInterface $next, int $month, float $percent)
    {
        $this->next = $next;
        $this->month = $month;
        $this->percent = $percent;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $cost = $this->next->getCost($items);
        if ($this->month === 12) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}