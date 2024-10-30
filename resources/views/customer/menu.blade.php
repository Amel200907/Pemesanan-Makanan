@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white relative">
        <div class="absolute inset-0 opacity-50">
            <img src="your-image-url.jpg" alt="Hero Background" class="object-cover w-full h-full">
        </div>
        <div class="container mx-auto px-4 py-16 relative z-10">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di SantapAja</h1>
            <p class="text-xl">Nikmati berbagai menu lezat kami</p>
        </div>
    </div>

    <!-- Menu Categories -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex overflow-x-auto pb-4 mb-8 space-x-4">
            @foreach($categories as $category)
            <button 
                class="category-btn px-6 py-2 bg-white rounded-full shadow-md text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-300"
                data-category="{{ $category }}"
                aria-label="Lihat kategori {{ $category }}">
                {{ $category }}
            </button>
            @endforeach
        </div>

        <!-- Menu Items -->
        @foreach($products as $category => $categoryProducts)
        <div class="category-section mb-12" id="category-{{ Str::slug($category) }}">
            <h2 class="text-2xl font-bold mb-6">{{ $category }}</h2>
            @if($categoryProducts->isEmpty())
                <p class="text-gray-600">Tidak ada produk tersedia di kategori ini.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categoryProducts as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <div class="flex items-center">
                                <span class="flex items-center">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600 ml-1">
                                        {{ $product->reviews->count() > 0 ? number_format($product->reviews->avg('rating'), 1) : 'Belum ada ulasan' }} 
                                        ({{ $product->reviews->count() }})
                                    </span>
                                </span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-300">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-btn');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            const section = document.getElementById('category-' + category.toLowerCase());
            section.scrollIntoView({ behavior: 'smooth' });
            
            // Update active state
            categoryButtons.forEach(btn => btn.classList.remove('bg-indigo-500', 'text-white'));
            this.classList.add('bg-indigo-500', 'text-white');
        });
    });
});
</script>
@endpush
@endsection
