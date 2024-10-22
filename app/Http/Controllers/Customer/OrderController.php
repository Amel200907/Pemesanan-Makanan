<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with('items.product')->where('user_id', auth()->id())->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Logic untuk membuat pesanan baru
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('customer.orders.show', compact('order'));
    }
}
