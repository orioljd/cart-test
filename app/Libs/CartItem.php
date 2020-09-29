<?php

namespace App\Libs;

use Exception;
use App\Libs\Product;

class CartItem
{
    private const MAXIMUM_UNITS = 5;

    private $units;
    private $product;

    public function __construct($product, $units)
    {
        $this->validateMaximumUnits($units);

        $this->units = $units;
        $this->product = $product;
    }

    public function sumUnits($units)
    {
        $totalUnits = $units + $this->units;
        $this->validateMaximumUnits($totalUnits);
        $this->units = $totalUnits;
    }

    public function substractUnits($units)
    {
        $totalUnits = $this->units - $units;
        if ($totalUnits < 0) {
            throw new Exception("Minimum units per product exceeded");
        }

        $this->units = $totalUnits;
    }

    public function sameBarcode($barcode)
    {
        return $this->product->getBarcode() == $barcode;
    }

    public function setUnits($units)
    {
        $this->units = $units;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getTotal()
    {
        $price = $this->product->getPrice();

        return $this->units * $price->getFinalPrice($this->units);
    }

    private function validateMaximumUnits($units)
    {
        if ($units > self::MAXIMUM_UNITS) {
            throw new Exception("Maximum units per product exceeded");
        }
    }
}
