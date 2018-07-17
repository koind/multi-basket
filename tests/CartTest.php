<?php

namespace Tests;

use koind\Cart;
use koind\cost\SimpleCost;
use koind\storage\MemoryStorage;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private $cart;

    public function setUp()
    {
        $this->cart = new Cart(new MemoryStorage(), new SimpleCost());
        parent::setUp();
    }
    
    public function testCreate()
    {
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testAdd()
    {
        $this->cart->add(5, 3, 100);
        $this->assertEquals(1, count($items = $this->cart->getItems()));
        $this->assertEquals(5, $items[5]->getId());
        $this->assertEquals(3, $items[5]->getCount());
        $this->assertEquals(100, $items[5]->getPrice());
    }

    public function testAddExist()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->add(5, 4, 100);
        $this->assertEquals(1, count($items = $this->cart->getItems()));
        $this->assertEquals(7, $items[5]->getCount());
    }

    public function testRemove()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->remove(5);
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testSubtractCount()
    {
        $this->cart->add(5, 4, 200);
        $this->cart->subtractCount(5, 2, 200);
        $this->assertEquals(1, count($items = $this->cart->getItems()));
        $this->assertEquals(5, $items[5]->getId());
        $this->assertEquals(2, $items[5]->getCount());
        $this->assertEquals(200, $items[5]->getPrice());
        $this->assertEquals(400, $items[5]->getCost());
    }

    public function testClear()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->clear();
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testCost()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->add(6, 4, 150);
        $this->assertEquals(900, $this->cart->getCost());
    }
}