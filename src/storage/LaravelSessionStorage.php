<?php

namespace koind\storage;

use koind\CartItem;
use Illuminate\Contracts\Session\Session;

class LaravelSessionStorage implements StorageInterface
{
    private $session;
    private $sessionKey;

    public function __construct(Session $session, $sessionKey = 'cart')
    {
        $this->session = $session;
        $this->sessionKey = $sessionKey;
    }

    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        return $this->session->get($this->sessionKey, []);
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        $this->session->put($this->sessionKey, $items);
    }
}