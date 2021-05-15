<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Promo;
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
        $total = 0;
        $products = Product::all();
        $promos = Promo::all();
        $order = Order::create([
            'total' => 0,
        ]);

        $data = $request->all();
//        dd($data['promo']);


        foreach ($data['quantity'] as $productId => $quantity) {
            if (!$quantity) {
                continue;
            }
            foreach ($products as $product) {
                if ($productId == $product->id) {
                    $total_amount = $product->price * $quantity;
                    break;
                }
            }
            $total += $total_amount;


            OrderProduct::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'quantity' => $quantity,
                'total_amount' => $total_amount,
            ]);
        }
        foreach ($promos as $promo) {
            if (!$data['promo']) {
                continue;
            } elseif ($promo->type == 'percent_off' && $data['promo'] == $promo->code) {
                $total = $total * $promo->value / 100;
                break;
            } elseif ($promo->type == 'amount_off' && $data['promo'] == $promo->code) {
                $total = $total - $promo->value;
                break;
            }
        }

        if ($total < 0) {
            $total = 0;
        }
        Order::where('id', $order->id)->update(['total' => $total,]);


//        dump($total);


        return redirect()->route('products_list');


    }
}
