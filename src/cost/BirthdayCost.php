<?php

namespace koind\cost;

use koind\CartItem;

class BirthdayCost implements CalculatorInterface
{
    private $next;
    private $percent;
    private $birthDate;
    private $currentDate;

    public function __construct(CalculatorInterface $next, float $percent, string $birthDate, string $currentDate)
    {
        $this->next = $next;
        $this->percent = $percent;
        $this->currentDate = $currentDate;
        $this->birthDate = $birthDate;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $birthDate = \DateTime::createFromFormat('Y-m-d', $this->birthDate);
        $currentDate = \DateTime::createFromFormat('Y-m-d', $this->currentDate);
        $cost = $this->next->getCost($items);
        if ($currentDate->format('m-d') == $birthDate->format('m-d')) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}