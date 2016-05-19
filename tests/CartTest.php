<?php

use App\Cart;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    public function testCartCanAddProduct()
    {
        $product = new Product('Ball', 1500);

        $cart = new Cart;

        $cart->add($product);

        $this->assertCount(1, $cart->items);
    }

    public function testCartCanAddTwoProductsAndReturnTotal()
    {
        $product1 = new Product('Ball', 1500);
        $product2 = new Product('Guitar', 55000);

        $cart = new Cart;

        $cart->add($product1);
        $cart->add($product2);

        $this->assertCount(2, $cart->items);
        $this->assertEquals(56500, $cart->total());
    }

    public function testCartCanRemoveProduct()
    {
        $product1 = new Product('Ball', 1500);
        $product2 = new Product('Guitar', 55000);

        $cart = new Cart;

        $cart->add($product1);
        $cart->add($product2);

        $this->assertCount(2, $cart->items);

        $cart->remove('Ball');
        $this->assertCount(1, $cart->items);
        $this->assertEquals('Guitar', $cart->items->first()->name);
    }
}
