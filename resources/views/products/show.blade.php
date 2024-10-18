@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
        </div>
        <div class="w-full md:w-1/2 px-4">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <p class="text-2xl font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <div class="flex items-center mb-4">
                <span class="text-yellow-500 mr-1">
                    <i class="fas fa-star"></i>
                </span>
                <span>{{ number_format($product->rating, 1) }} ({{ $product->rating_count }} ulasan)</span>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambahkan ke Keranjang
                </button>
            </form>
        </div>
    </div>
</div>
<div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">Ulasan Produk</h2>
    @auth
        <form action="{{ route('reviews.store', $product) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
                <select name="rating" id="rating" class="w-full border rounded px-3 py-2">
                    <option value="5">5 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="1">1 Bintang</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-gray-700 font-bold mb-2">Komentar</label>
                <textarea name="comment" id="comment" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Kirim Ulasan</button>
        </form>
    @endauth
    
    @forelse ($product->reviews as $review)
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center mb-2">
                <span class="text-yellow-500 mr-1">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </span>
                <span class="font-semibold">{{ $review->user->name }}</span>
            </div>
            <p class="text-gray-700">{{ $review->comment }}</p>
            <span class="text-sm text-gray-600">{{ $review->created_at->diffForHumans() }}</span>
        </div>
    @empty
        <p class="text-gray-600">Belum ada ulasan untuk produk ini.</p>
    @endforelse
</div>
@endsection