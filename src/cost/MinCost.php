<?php

namespace Koind\cost;

use Koind\CartItem;

class MinCost implements CalculatorInterface
{
    /**
     * @var CalculatorInterface[]
     */
    private $calculators;

    public function __construct(...$calculators)
    {
        foreach ($calculators as $calculator) {
            if (!$calculator instanceof CalculatorInterface) {
                throw new \InvalidArgumentException('Invalid calculator');
            }
        }
        $this->calculators = $calculators;
    }

    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items): float
    {
        $costs = [];
        foreach ($this->calculators as $calculator) {
            $costs[] = $calculator->getCost($items);
        }
        return min($costs);
    }
}