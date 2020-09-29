<?php

namespace Tests\Unit;

use Exception;
use App\Libs\Cart;
use PHPUnit\Framework\TestCase;

class ItemCollectionTest extends TestCase
{
    public function testDeletesAfterInsertingAnItem()
    {
        $cart = new Cart();
        $cart->addProduct('P00001', 2);
        $cart->removeProduct('P00001', 2);

        $this->assertEquals(0, $cart->getNumberOfItems());
    }


    public function testExceededItemsInCart()
    {
        $cart = new Cart();

        $cart->addProduct('P00001', 1);
        $cart->addProduct('P00002', 1);
        $cart->addProduct('P00003', 1);
        $cart->addProduct('P00004', 1);
        $cart->addProduct('P00005', 1);
        $cart->addProduct('P00006', 1);
        $cart->addProduct('P00007', 1);
        $cart->addProduct('P00008', 1);
        $cart->addProduct('P00009', 1);
        $cart->addProduct('P000010', 1);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Maximum of items exceeded in Cart');

        $cart->addProduct('P000011', 1);
    }
}
