<?php

namespace Tests\cost;

use koind\cost\DummyCost;
use koind\cost\FridayCost;
use PHPUnit\Framework\TestCase;

class FridayCostTest extends TestCase
{
    /**
     * @dataProvider getDays
     */
    public function testCost($date, $cost)
    {
        $calculator = new FridayCost(new DummyCost(100), 5, $date);
        $this->assertEquals($cost, $calculator->getCost([]));
    }

    public function getDays()
    {
        return [
            'Monday' => ['2018-07-16', 100],
            'Tuesday' => ['2018-07-17', 100],
            'Wednesday' => ['2018-07-18', 100],
            'Thursday' => ['2018-07-19', 100],
            'Friday' => ['2018-07-20', 95],
            'Saturday' => ['2018-07-21', 100],
            'Sunday' => ['2018-07-22', 100],
        ];
    }
}