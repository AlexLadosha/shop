<?php

namespace App\Http\Controllers;

use App\Services\OrdersService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder()
    {
        $products = ProductsService::getProducts();
        return view('orders\create', ['products' => $products]);
    }

    public function saveOrder(Request $request)
    {
        $quantity = $request->input('quantity');
        $promoCode = $request->input('promo_code');

        if(!is_array($quantity)) {
            return ;
        }

        OrdersService::createOrder($quantity, $promoCode);

        return redirect()->route('products_list');
    }
}
