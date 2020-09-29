<?php

namespace Tests\Unit;

use Exception;
use App\Libs\Cart;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    public function testMaximumExceededUnits()
    {
        $cart = new Cart();

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Maximum units per product exceeded');

        $cart->addProduct('P00001', 6);
    }

    public function testMinimumExceededUnits()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 1);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Minimum units per product exceeded');

        $cart->removeProduct('P00001', 2);
    }

    public function testSubstractUnits()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 4);
        $cart->removeProduct('P00001', 2);

        $itemCart = $cart->getItem('P00001');

        $this->assertEquals(2, $itemCart->getUnits());
    }

    public function testSumUnits()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 4);
        $cart->addProduct('P00001', 1);

        $itemCart = $cart->getItem('P00001');

        $this->assertEquals(5, $itemCart->getUnits());
    }

    public function testMaximumExceededOnSumUnits()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 4);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Maximum units per product exceeded');

        $cart->addProduct('P00001', 2);
    }

    public function testMinimumExceededOnSubstractUnits()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 2);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Minimum units per product exceeded');

        $cart->removeProduct('P00001', 3);
    }
}
