<?php

namespace koind\cost;

use koind\CartItem;

class FridayCost implements CalculatorInterface
{
    private $next;
    private $percent;
    private $date;

    public function __construct(CalculatorInterface $next, float $percent, string $date)
    {
        $this->next = $next;
        $this->date = $date;
        $this->percent = $percent;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $now = \DateTime::createFromFormat('Y-m-d', $this->date);
        $cost = $this->next->getCost($items);
        if ($now->format('l') == 'Friday') {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $this->next->getCost($items);
        }
    }
}