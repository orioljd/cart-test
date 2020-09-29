<?php

namespace App\Libs;

class Price
{
    private $offerPrice;
    private $standardPrice;
    private $minimumUnitsForOffer;


    public function __construct($standardPrice, $offerPrice, $minimumUnitsForOffer)
    {
        $this->standardPrice = $standardPrice;
        $this->offerPrice = $offerPrice;
        $this->minimumUnitsForOffer = $minimumUnitsForOffer;
    }

    public function getFinalPrice($units)
    {
        if ($units >= $this->minimumUnitsForOffer) {
            return $this->offerPrice;
        }

        return $this->standardPrice;
    }

}
