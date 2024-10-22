@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Pesanan</h2>
            <p class="text-2xl font-bold">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Pesanan Tertunda</h2>
            <p class="text-2xl font-bold">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Produk</h2>
            <p class="text-2xl font-bold">{{ $stats['total_products'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Pelanggan</h2>
            <p class="text-2xl font-bold">{{ $stats['total_customers'] }}</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold mt-8 mb-4">Pesanan Terbaru</h2>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 border-b">ID Pesanan</th>
                <th class="py-2 border-b">Pelanggan</th>
                <th class="py-2 border-b">Status</th>
                <th class="py-2 border-b">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recent_orders as $order)
            <tr>
                <td class="py-2 border-b">{{ $order->id }}</td>
                <td class="py-2 border-b">{{ $order->user->name }}</td>
                <td class="py-2 border-b">{{ ucfirst($order->status) }}</td>
                <td class="py-2 border-b">{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
