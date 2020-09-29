<?php

namespace Tests\Unit;

use Exception;
use App\Libs\Cart;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    public function testNotExistInStock()
    {
        $cart = new Cart();

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('There is not this item in Stock');

        $cart->addProduct('AAAAAA', 1);
    }
}
