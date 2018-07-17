<?php

namespace Tests\cost;

use koind\CartItem;
use koind\cost\SimpleCost;
use PHPUnit\Framework\TestCase;

class SimpleCostTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new SimpleCost();
        $this->assertEquals(1000, $calculator->getCost([
            5 => new CartItem(5, 2, 200),
            7 => new CartItem(7, 4, 150),
        ]));
    }
}