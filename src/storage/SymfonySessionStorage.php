<?php

namespace Koind\storage;

use Koind\CartItem;
use Symfony\Component\HttpFoundation\Session\Session;

class SymfonySessionStorage implements StorageInterface
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
        $this->session->set($this->sessionKey, $items);
    }
}