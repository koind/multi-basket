# Multi-basket
A universal component of the basket that can be used in any php framework.

## Installation

Run the following command from you terminal:


 ```bash
 composer require "koind/multi-basket: ^1.0"
 ```

or add this to require section in your composer.json file:

 ```
 "koind/multi-basket": "^1.0"
 ```

then run ```composer update```


## Usage

First, you need to plug the required classes and initialized this classes.
Next, create an instance of the Cart class by passing the appropriate arguments. 
Congratulations You can use the functionality of the basket.

```php
<?php 

use koind\storage\LaravelHybridStorage;
use koind\Cart;
use koind\cost\SimpleCost;
use koind\cost\MinCost;
use koind\cost\FridayCost;
use koind\cost\NewYearCost;

require __DIR__ . '/vendor/autoload.php';

$storage = new LaravelHybridStorage('cart');

$simpleCost = new SimpleCost();
$calculator = new MinCost(
    new FridayCost($simpleCost, 5, date('Y-m-d')),
    new NewYearCost($simpleCost, date('m'), 3)
);

$cart = new Cart($storage, $calculator);
$cart->add(5, 6, 100);
```

## Available Methods

The following methods are available:

##### koind\Cart

```php
public function getItems(): array
public function add(int $id, int $count, int $price): void
public function subtractCount(int $id, int $count, int $price): void
public function getCost(): float
public function remove(int $id): void
public function clear(): void
```

##### koind\CartItem

```php
public function getId(): int
public function getCount(): float
public function getPrice(): float
public function getCost(): float
```

##### koind\cost\CalculatorInterface

This interface implements all types of classes necessary for discounts.

```php
public function getCost(array $items): float
```

##### koind\storage\StorageInterface

This interface implements all types of classes required for data storage.

```php
public function load(): array
public function save(array $items): void
```


### Example usage class Cart


Get all products from the cart:

```php
$this->cart->getItems();
```

Add a new product to your cart:

```php
$this->cart->add(3, 4, 1000);
```

Changing the quantity of product:

```php
$this->cart->subtractCount(3, 2, 1000);
```

Get the total cost of goods, including all discounts:

```php
$this->cart->getCost();
```

Remove product from cart:

```php
$this->cart->remove(3);
```

Clear cart:

```php
$this->cart->clear();
```

## Different storages

An example of a storage implementation for different frameworks.

##### koind\storage\LaravelSessionStorage - for Laravel 

```php
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
```

##### koind\storage\SymfonySessionStorage - for Symfony 

```php
<?php

namespace koind\storage;

use koind\CartItem;
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
```

##### koind\storage\YiiSessionStorage - for Yii 

```php
<?php

namespace koind\storage;

use koind\CartItem;
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
```

If you need a component for another framework, you can easily implement the interface ```StorageInterface```

## Tests

Run the following command from you terminal:

```
phpunit
```