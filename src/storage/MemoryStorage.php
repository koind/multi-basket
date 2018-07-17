<?php

namespace koind\storage;

use koind\CartItem;

class MemoryStorage implements StorageInterface
{
    private $items = [];

    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        return $this->items;
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        $this->items = $items;
    }
}