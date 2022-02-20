<?php

namespace App\Models;
class Product {
    protected $name;
    protected $price;
    public function __construct($name, $price = null) {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return is_null($this->price) ? 0 : $this->price;
    }

}
