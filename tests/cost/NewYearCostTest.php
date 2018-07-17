<?php

namespace Tests\cost;

use Koind\cost\DummyCost;
use Koind\cost\NewYearCost;
use PHPUnit\Framework\TestCase;

class NewYearCostTest extends TestCase
{
    public function testActive()
    {
        $calculator = new NewYearCost(new DummyCost(1000), 12, 5);
        $this->assertEquals(950, $calculator->getCost([]));
    }

    public function testNone()
    {
        $calculator = new NewYearCost(new DummyCost(1000), 6, 5);
        $this->assertEquals(1000, $calculator->getCost([]));
    }
}