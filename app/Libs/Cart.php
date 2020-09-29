<?php

namespace App\Libs;

use Exception;
use App\Libs\Stock;
use App\Libs\CartItem;
use App\Libs\Currency;
use App\Libs\ItemCollection;

class Cart
{
    private $items;
    private $stock;
    private $currency;

    public function __construct()
    {
        $this->stock = new Stock();
        $this->items = new ItemCollection();
        $this->currency = new Currency();
    }

    public function getTotal($currency = 'EUR')
    {
        $total = $this->items->getTotal();
        if ($currency != 'EUR') {
            // As currency service says, they only update the values every 24h.
            // I let the cart updated on each request for testing purposes,
            // but in prod env it would retrieve the last value from a database,
            // not in real time
            $this->currency->fillCurrencies();
            return $total * $this->currency->getRate($currency);
        } else {
            return $total;
        }
    }

    public function addProduct($barcode, $units)
    {
        $productInStock = $this->stock->getProduct($barcode);

        try {
            $cartItem = $this->items->getItem($barcode);
        } catch (Exception $e) {
            $cardItem = new CartItem($productInStock, $units);
            $this->items->addItem($cardItem);
            return;
        }
        $cartItem->sumUnits($units);
    }

    public function removeProduct($barcode, $units)
    {
        $cartItem = $this->items->getItem($barcode);

        $cartItem->substractUnits($units);
        if ($cartItem->getUnits() == 0) {
            $this->items->removeItem($cartItem);
        }
    }

    public function getNumberOfItems()
    {
        return $this->items->getNumberOfItems();
    }

    public function getItem($barcode)
    {
        $cartItem = $this->items->getItem($barcode);

        return $cartItem;
    }
}
