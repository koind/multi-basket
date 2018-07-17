<?php

namespace koind\storage;

use koind\CartItem;

class SessionStorage implements StorageInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        return isset($_SESSION[$this->key]) ? unserialize($_SESSION[$this->key]) : [];
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        $_SESSION[$this->key] = serialize($items);
    }
}