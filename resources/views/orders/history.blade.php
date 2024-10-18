@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Riwayat Pesanan</h1>
    @forelse ($orders as $order)
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Pesanan #{{ $order->id }}</h2>
                <span class="text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Item Pesanan:</h3>
                <ul>
                    @foreach ($order->products as $product)
                        <li>{{ $product->name }} (x{{ $product->pivot->quantity }}) - Rp {{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-sm">{{ ucfirst($order->status) }}</span>
            </div>
        </div>
    @empty
        <p class="text-gray-600">Anda belum memiliki riwayat pesanan.</p>
    @endforelse
    {{ $orders->links() }}
</div>
@endsection