@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-2">Total Orders</h2>
            <p class="text-3xl">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-2">Total Products</h2>
            <p class="text-3xl">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-2">Total Users</h2>
            <p class="text-3xl">{{ $totalUsers }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">Order ID</th>
                    <th class="text-left">User</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection