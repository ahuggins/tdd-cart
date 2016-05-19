<?php

namespace App;

class Cart
{
    public $items;

    public function __construct()
    {
        $this->items = collect();
    }

    public function add($product)
    {
        $this->items[] = $product;
    }

    public function total()
    {
        return $this->items->sum('price');
    }

    public function remove($name)
    {
        $this->items = $this->items->reject(function ($item) use ($name) {
            return $item->name == $name;
        });
    }
}
