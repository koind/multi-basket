<?php

namespace Tests\cost;

use Koind\cost\BirthdayCost;
use Koind\cost\DummyCost;
use PHPUnit\Framework\TestCase;

class BirthdayCostTest extends TestCase
{
    public function testActive()
    {
        $calc = new BirthdayCost(new DummyCost(100), 5, '1990-07-17', '2018-07-17');
        $this->assertEquals(95, $calc->getCost([]));
    }

    public function testNone()
    {
        $calc = new BirthdayCost(new DummyCost(100), 5, '1990-04-17', '2018-07-17');
        $this->assertEquals(100, $calc->getCost([]));
    }
}