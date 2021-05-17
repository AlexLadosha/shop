<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public static function getProducts()
    {
        return Product::with('category')->get();
    }
}
