<?php

namespace Koind;

use Koind\cost\CalculatorInterface;
use Koind\storage\StorageInterface;

class Cart
{
    /**
     * @var CartItem[]
     */
    private $items;
    private $storage;
    private $calculator;

    public function __construct(StorageInterface $storage, CalculatorInterface $calculator)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
    }

    public function getItems(): array
    {
        $this->loadItems();
        return $this->items;
    }

    public function add(int $id, int $count, int $price): void
    {
        $this->loadItems();
        $current = isset($this->items[$id]) ? $this->items[$id]->getCount() : 0;
        $this->items[$id] = new CartItem($id, $current + $count, $price);
        $this->saveItems();
    }

    public function subtractCount(int $id, int $count, int $price)
    {
        $this->loadItems();
        if (!isset($this->items[$id])) {
            throw new \InvalidArgumentException("Not fount is product");
        }
        $this->items[$id] = new CartItem($id, $count, $price);
        $this->saveItems();
    }

    public function remove(int $id): void
    {
        $this->loadItems();
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }
        $this->saveItems();
    }

    public function clear(): void
    {
        $this->items = [];
        $this->saveItems();
    }

    public function getCost(): float
    {
        $this->loadItems();
        return $this->calculator->getCost($this->items);
    }

    private function loadItems(): void
    {
        if ($this->items === null) {
            $this->items = $this->storage->load();
        }
    }

    private function saveItems(): void
    {
        $this->storage->save($this->items);
    }

}