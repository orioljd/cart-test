<?php

namespace App\Libs;

use App\Libs\Price;

class Product
{
    private $barcode;
    private $price;

    public function __construct($barcode, Price $price)
    {
        $this->barcode = $barcode;
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }
}
