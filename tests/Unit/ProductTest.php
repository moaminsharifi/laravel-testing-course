<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
class ProductTest extends TestCase
{
    public function setUp() :void
    {

        $this->product = new Product('Product 1', 10);
        parent::setUp();
    }
    public function test_product_has_name()
    {
        $this->assertEquals('Product 1', $this->product->getName());
    }
    public function test_product_has_price(){
        $this->assertEquals(10, $this->product->getPrice());
    }
}
