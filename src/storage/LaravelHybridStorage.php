<?php

namespace Koind\storage;

use Koind\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class LaravelHybridStorage implements StorageInterface
{
    private $storage;

    public function __construct(Session $session, string $sessionKey)
    {
        $sessionStorage = new LaravelSessionStorage($session, $sessionKey);

        if (!Auth::check()) {
            $this->storage = $sessionStorage;
        } else {
            $dbStorage = new LaravelDbStorage(Auth::user()->id);
            if ($sessionItems = $sessionStorage->load()) {
                $items = array_merge($dbStorage->load(), $sessionItems);
                $dbStorage->save($items);
                $sessionStorage->save([]);
            }
            $this->storage = $dbStorage;
        }

    }

    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        $this->storage->load();
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        $this->storage->save($items);
    }
}