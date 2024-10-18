<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $product->price * $request->quantity,
            'status' => 'pending',
        ]);

        $order->products()->attach($product->id, ['quantity' => $request->quantity]);

        return redirect()->route('cart');
    }

    public function cart()
    {
        $pendingOrder = auth()->user()->orders()->where('status', 'pending')->first();
        return view('cart', compact('pendingOrder'));
    }

    public function checkout()
    {
        $order = auth()->user()->orders()->where('status', 'pending')->first();
        $order->update(['status' => 'completed']);
        return redirect()->route('menu')->with('success', 'Order placed successfully!');
    }

    public function rate(Request $request, Order $order)
    {
        $order->update(['rating' => $request->rating]);
        return back()->with('success', 'Thank you for your rating!');
    }
}
