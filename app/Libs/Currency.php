<?php

namespace App\Libs;

use Exception;

class Currency
{

    private $currencies;

    public function __construct()
    {
        $this->currencies = [];
    }

    public function fillCurrencies()
    {
        $XMLContent = file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

        foreach ($XMLContent as $line) {
            if (preg_match("/currency='([[:alpha:]]+)'/", $line, $currencyCode)) {
                if (preg_match("/rate='([[:graph:]]+)'/", $line, $rate)) {
                    $this->currencies[$currencyCode[1]] = $rate[1];
                }
            }
        }
    }
    public function getRate($currencyIso)
    {
        if (!isset($this->currencies[$currencyIso])) {
            throw new Exception("This currency is not available");
        }

        return $this->currencies[$currencyIso];
    }
}
