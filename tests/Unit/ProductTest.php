<?php

namespace Tests\Unit;


use App\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function AProductName()
    {
        $product = new Product('iPhone 7', 6000);

        $this->assertEquals('iPhone 7', $product->name());
    }

    /**
     * @test
     */
    public function AProductPrice()
    {
        $product = new Product('Macbook', 10000);

        $this->assertEquals(10000, $product->price());
    }

    /** @test */
    public function aProductCanBeSoldWithDiscount()
    {
        $prouduct = new Product('Macbook', 10000);
        $prouduct->setDiscount(8);
        $this->assertEquals(8000,$prouduct->price());

    }
}
