<?php

namespace koind\storage;

use koind\CartItem;

class HybridStorage implements StorageInterface
{
    private $storage;

    public function __construct(StorageInterface $form, StorageInterface $to)
    {
        $items = array_merge($form->load(), $to->load());
        $form->save([]);
        $to->save($items);
        $this->storage = $to;
    }
    
    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        return $this->storage->load();
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        $this->storage->save($items);
    }
}