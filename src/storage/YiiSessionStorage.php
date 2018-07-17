<?php

namespace Koind\storage;

use Koind\CartItem;
use Yii;

class YiiSessionStorage implements StorageInterface
{
    private $sessionKey;

    public function __construct($sessionKey = 'cart')
    {
        $this->sessionKey = $sessionKey;
    }

    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        return Yii::$app->session->get($this->sessionKey, []);
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        Yii::$app->session->set($this->sessionKey, $items);
    }
}