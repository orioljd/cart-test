<?php

namespace App\Libs;

use Exception;
use App\Libs\CartItem;

class ItemCollection
{
    private const MAXIMUM_PRODUCTS = 10;

    private $items;

    public function __construct()
    {
        $this->items = collect();
    }

    public function getItem($barcode)
    {
        $itemFiltered = $this->items->filter(function (CartItem $item) use ($barcode) {
            return $item->sameBarcode($barcode);
        });

        if (count($itemFiltered) > 0) {
            return $itemFiltered->first();
        }

        throw new Exception("There is not this item in Cart");
    }

    public function addItem(CartItem $itemToAdd)
    {
        if ((count($this->items) + 1) > self::MAXIMUM_PRODUCTS) {
            throw new Exception("Maximum of items exceeded in Cart");
        }

        $this->items[] = $itemToAdd;
    }

    public function removeItem($itemToRemove)
    {
        $this->items = $this->items->filter(function ($item) use ($itemToRemove) {
            return $item !== $itemToRemove;
        });
    }

    public function getTotal()
    {
        return $this->items->sum(function ($item) {
            return $item->getTotal();
        });
    }

    public function getNumberOfItems()
    {
        return count($this->items);
    }
}
