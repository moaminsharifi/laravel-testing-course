<?php
namespace App\Models;
class Order {
    protected $products = [];

    public function __construct(
    ){
        $this->products = [];
    }
    public function add(Product $product) {
        $this->products[] = $product;
    }
    public function getProducts(){
        return $this->products;
    }
    public function total(){
        $total = 0;
        foreach($this->products as $product){
            $total += $product->getPrice();
        }
        return $total;
    }
}
