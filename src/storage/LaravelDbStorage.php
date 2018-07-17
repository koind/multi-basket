<?php

namespace koind\storage;

use koind\CartItem;
use Illuminate\Support\Facades\DB;

class LaravelDbStorage implements StorageInterface
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
    
    /**
     * @return CartItem[]
     */
    public function load(): array
    {
        $items = [];
        $carts = DB::table('cart')->where('user_id', '=', $this->userId)->get();
        if (!empty($carts)) {
            foreach ($carts as $cart) {
                $items[$cart->product_id] = new CartItem($cart->product_id, $cart->count, $cart->price);
            }
        }
        return $items;
    }

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void
    {
        DB::table('cart')->where('user_id', '=', $this->userId)->delete();
        foreach ($items as $item) {
            DB::table('cart')->insert(
                [
                    'user_id'       => $this->userId,
                    'product_id'    => $item->getId(),
                    'price'         => $item->getPrice(),
                    'count'         => $item->getCount()
                ]
            );
        }
    }
}