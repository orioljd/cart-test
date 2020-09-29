<?php

namespace App\Libs;

use Exception;
use App\Libs\Price;
use App\Libs\Product;

class Stock
{
    private $items;

    public function __construct()
    {
        $this->items = [];
        $this->fillStock();
    }

    public function getProduct($barcode)
    {
        $products = collect($this->items)->filter(function (Product $product) use ($barcode) {
            return $barcode == $product->getBarcode();
        });

        if (count($products) > 0) {
            return $products->first();
        }

        throw new Exception("There is not this item in Stock");
    }

    private function fillStock()
    {
        $price = new Price(10, 9, 3);
        $product = new Product('P00001', $price);
        $this->items[] = $product;

        $price = new Price(20, 19, 2);
        $product = new Product('P00002', $price);
        $this->items[] = $product;

        $price = new Price(30, 15, 1);
        $product = new Product('P00003', $price);
        $this->items[] = $product;

        $price = new Price(40, 20, 4);
        $product = new Product('P00004', $price);
        $this->items[] = $product;

        for ($i = 5; $i <= 11; $i++) {
            $price = new Price(10, 9, 3);
            $product = new Product('P0000' . $i, $price);
            $this->items[] = $product;
        }
    }
}
