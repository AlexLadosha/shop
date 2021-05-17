<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Promo;

class OrdersService
{
    public static function createOrder($itemsQuantity, $promoCode)
    {
        $total = 0;
        $order = Order::create([
            'total' => 0,
            'discount-total' => 0,
        ]);

        foreach ($itemsQuantity as $productId => $quantity) {
            if (!$quantity) {
                continue;
            }
            $product = Product::where('id', $productId)->first();
            $productTotal = $product->price * $quantity;
            $total += $productTotal;
            $stock = $product->in_stock - $quantity;
            Product::where('id', $productId)->update(['in_stock' => $stock,]);

            OrderProduct::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'quantity' => $quantity,
                'total_amount' => $productTotal,
            ]);
        }

        $discountTotal = $total;
        if ($promoCode) {
            $promo = Promo::where('code', $promoCode)->first();
            if ($promo) {
                if ($promo->type === 'percent_off') {
                    $discountTotal = (int)( $total * (100 - $promo->value) / 100);
                } elseif ($promo->type === 'amount_off') {
                    $discountTotal = $total - $promo->value;
                }
            }
        }

        if ($discountTotal < 0) {
            $discountTotal = 0;
        }
        Order::where('id', $order->id)->update(['total' => $total, 'discount-total' => $discountTotal,]);

    }
}
