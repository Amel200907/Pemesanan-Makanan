@if(isset($query))
    <p class="mb-4">Hasil pencarian untuk: {{ $query }}</p>
@endif
<form action="{{ route('products.index') }}" method="GET" class="mb-4">
    <select name="category" class="p-2 border rounded">
        <option value="">Semua Kategori</option>
        <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
        <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
    </select>
    <select name="sort" class="p-2 border rounded">
        <option value="">Urutkan</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
    </select>
    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Terapkan</button>
</form>