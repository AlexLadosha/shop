<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder()
    {
        $products = Product::with('category')->get();
        return view('orders\create', ['products' => $products]);

    }

    public function saveOrder(Request $request)
    {
        $products = Product::all();
        $order = Order::create([
        ]);

        $data = $request->all();
//        dd($data);


        foreach ($data['quantity'] as $productId => $quantity) {
            if ($productId && $quantity !== null) {
                foreach ($products as $product) {
                    if ($productId == $product->id) {
                        $total_amount = $product->price * $quantity;
//                        dd($productId);
                    }
                }

                OrderProduct::create([
                    'product_id' => $productId,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                    'total_amount' => $total_amount,

                ]);
            }
        }
        return redirect()->route('products_list');


    }
}
