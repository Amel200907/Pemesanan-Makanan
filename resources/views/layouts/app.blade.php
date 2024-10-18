<form action="{{ route('products.search') }}" method="GET" class="flex items-center">
    <input type="text" name="query" placeholder="Cari produk..." class="rounded-l-lg p-2 border-t border-b border-l text-gray-800 border-gray-200 bg-white">
    <button type="submit" class="px-4 bg-blue-500 text-white font-bold p-2 rounded-r-lg">
        <i class="fas fa-search"></i>
    </button>
</form>