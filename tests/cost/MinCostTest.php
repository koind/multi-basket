<?php

namespace Tests\cost;

use koind\cost\DummyCost;
use koind\cost\MinCost;
use PHPUnit\Framework\TestCase;

class MinCostTest extends TestCase
{
    public function testMin()
    {
        $calc = new MinCost(new DummyCost(100), new DummyCost(80), new DummyCost(90));
        $this->assertEquals(80, $calc->getCost([]));
    }
}