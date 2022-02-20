<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\Order;
class OrderTest extends TestCase
{

    function test_an_order_consists_of_products()
    {
        $order = new Order;
        $product1 = new Product('Product 1', 10);
        $product2 = new Product('Product 2', 20);

        $order->add($product1);
        $order->add($product2);

        $this->assertCount(2, $order->getProducts());
    }
    public function test_order_can_calculate_total_price(){
        $order = new Order;
        $product1 = new Product('Product 1', 10);
        $product2 = new Product('Product 2', 20);

        $order->add($product1);
        $order->add($product2);

        $this->assertEquals(30, $order->total());
    }
}
