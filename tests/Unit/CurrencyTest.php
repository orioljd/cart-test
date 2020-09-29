<?php

namespace Tests\Unit;

use Exception;
use App\Libs\Cart;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testGetTotalInPoundsCurrency()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 1);

        $totalInEur = $cart->getTotal();
        $totalInGbp = $cart->getTotal('GBP');

        $this->assertLessThan($totalInEur, $totalInGbp);
    }

    public function testNotExistCurrency()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 1);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('This currency is not available');

        $cart->getTotal('AAAA');
    }
}
