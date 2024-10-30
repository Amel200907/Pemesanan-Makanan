<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left Sidebar - Categories -->
            <div class="w-full md:w-64 overflow-y-scroll" style="max-height: 60vh;">
                <div class="bg-sky-100 rounded-lg p-4 mb-4">
                    <h2 class="text-lg font-bold mb-4">Kategori Menu</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-700 hover:text-sky-600">
                                <span>Beverages</span>
                                <span class="text-sm text-gray-500">(1)</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-700 hover:text-sky-600">
                                <span>Snack</span>
                                <span class="text-sm text-gray-500">(1)</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-700 hover:text-sky-600">
                                <span>Drinks</span>
                                <span class="text-sm text-gray-500">(1)</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-lg p-4 mb-4">
                    <h2 class="text-lg font-bold mb-4">Keranjang Belanja</h2>
                    <div class="text-center border-t pt-4">
                        <p class="text-gray-500 mb-2">Rp.0,00</p>
                        <p id="cartItemCount" class="text-sm text-gray-400">(0 item)</p>
                    </div>
                </div>

                <!-- Promo Banner -->
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ $promoBanner ?? 'https://via.placeholder.com/400x200' }}" alt="Promo Banner" class="w-full">
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Favorite Menu Section -->
                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Favorite Menu</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($favoriteMenus as $menu)
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold mb-2">{{ $menu->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $menu->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-red-500">Rp {{ number_format($menu->price, 2) }}</span>
                                    <div class="space-x-2">
                                        <button onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})" class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-600">
                                            Beli Sekarang
                                        </button>
                                        <button onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600">
                                            + Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- New Menu Section -->
                <section>
                    <h2 class="text-2xl font-bold mb-6">Menu Terbaru</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($newMenus as $menu)
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold mb-2">{{ $menu->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $menu->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-red-500">Rp {{ number_format($menu->price, 2) }}</span>
                                    <div class="space-x-2">
                                        <button onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})" class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-600">
                                            Beli Sekarang
                                        </button>
                                        <button onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})" class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600">
                                            + Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div id="cartModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg max-w-md mx-auto mt-20 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Keranjang Belanja</h3>
                <button onclick="closeCart()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="cartItems" class="space-y-4">
                <!-- Cart items will be dynamically added here -->
            </div>
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between mb-2">
                    <span>Total:</span>
                    <span id="cartTotal" class="font-bold">Rp 0,00</span>
                </div>
                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <script>
        let cartItems = [];

        function openCart() {
            document.getElementById('cartModal').classList.remove('hidden');
            renderCart();
        }

        function closeCart() {
            document.getElementById('cartModal').classList.add('hidden');
        }

        function addToCart(menuId, name, price) {
            const itemIndex = cartItems.findIndex(item => item.menuId === menuId);
            if (itemIndex === -1) {
                cartItems.push({ menuId, name, price, quantity: 1 });
            } else {
                cartItems[itemIndex].quantity += 1;
            }
            renderCart();
        }

        function renderCart() {
            const cartItemsContainer = document.getElementById('cartItems');
            const cartItemCount = document.getElementById('cartItemCount');
            const cartTotal = document.getElementById('cartTotal');
            
            cartItemsContainer.innerHTML = '';
            let total = 0;

            cartItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                cartItemsContainer.innerHTML += `
                    <div class="flex justify-between items-center">
                        <span>${item.name} (x${item.quantity})</span>
                        <span>Rp ${itemTotal.toFixed(2)}</span>
                    </div>
                `;
            });

            cartItemCount.textContent = `(${cartItems.length} item)`;
            cartTotal.textContent = `Rp ${total.toFixed(2)}`;
        }
    </script>
</body>
</html>
