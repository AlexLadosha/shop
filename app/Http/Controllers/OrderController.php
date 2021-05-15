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
            'total' => 0,
        ]);

        $data = $request->all();
//        dd($data);


        foreach ($data['quantity'] as $productId => $quantity) {
            if (!$quantity) {
                continue;
            }
            foreach ($products as $product) {
                if ($productId == $product->id) {
                    $total_amount = $product->price * $quantity;
                    break;
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

        $orderTotals = OrderProduct::where('order_id', $order->id)->get();
        $total = 0;
        foreach ($orderTotals as $orderTotal) {

            $total += $orderTotal->total_amount;

        }
//        dump($total);

        Order::where('id', $order->id)->insert([
            'total' => $total,
        ]);


        return redirect()->route('products_list');


    }
}
