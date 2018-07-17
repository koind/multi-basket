<?php

namespace koind;

class CartItem
{
    private $id;
    private $count;
    private $price;

    public function __construct($id, $count, $price)
    {
        $this->id = $id;
        $this->count = $count;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCost(): float
    {
        return $this->price * $this->count;
    }
}