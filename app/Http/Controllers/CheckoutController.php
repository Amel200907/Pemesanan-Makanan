<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'completed',
        ]);

        foreach ($cartItems as $productId => $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('menu')->with('success', 'Order placed successfully!');
    }
}
