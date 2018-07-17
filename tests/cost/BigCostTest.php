<?php

namespace Tests\cost;

use koind\cost\BigCost;
use koind\cost\DummyCost;
use PHPUnit\Framework\TestCase;

class BigCostTest extends TestCase
{
    public function testAction()
    {
        $calculator = new BigCost(new DummyCost(1000), 500, 3);
        $this->assertEquals(970, $calculator->getCost([]));
    }

    public function testNone()
    {
        $calculator = new BigCost(new DummyCost(300), 500, 5);
        $this->assertEquals(300, $calculator->getCost([]));
    }
}