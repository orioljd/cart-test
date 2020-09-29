<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Libs\Cart;

class CartTest extends TestCase
{

    public function testGetTotalWithOffer()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 3);

        $this->assertEquals(27, $cart->getTotal());
    }

    public function testGetTotalWithoutOffer()
    {
        $cart = new Cart();
        $cart->addProduct('P00004', 3);

        $this->assertEquals(120, $cart->getTotal());
    }

    public function testGetTotalManyProducts()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 1); // 10
        $cart->addProduct('P00002', 2); // 38
        $cart->addProduct('P00003', 3); // 45
        $cart->addProduct('P00004', 4); // 80

        $this->assertEquals(173, $cart->getTotal());
    }
}
