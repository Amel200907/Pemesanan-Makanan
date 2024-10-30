<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sego - Restaurant Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-pink-200 rounded-lg flex items-center justify-center">
                        <span class="text-pink-500 font-semibold">Sg</span>
                    </div>
                    <span class="text-2xl font-bold text-indigo-900">Sego</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-8">
                <a href="#" class="flex items-center px-6 py-3 bg-pink-100 text-pink-500">
                    <i class="fas fa-home mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
                    <i class="fas fa-shopping-bag mr-3"></i>
                    <span>Orders</span>
                    <span class="ml-auto bg-pink-100 text-pink-600 text-xs px-2 py-1 rounded-full">25</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
                    <i class="fas fa-utensils mr-3"></i>
                    <span>Menus</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
                    <i class="fas fa-users mr-3"></i>
                    <span>Customers</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
                    <i class="fas fa-chart-line mr-3"></i>
                    <span>Analytics</span>
                </a>
            </nav>

            <!-- Add Menu Button -->
            <div class="px-6 mt-8">
                <button class="w-full bg-indigo-900 text-white py-2 px-4 rounded-lg">
                    + Add Menus
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center flex-1">
                        <h1 class="text-xl font-bold text-gray-800">Analytics</h1>
                        <div class="ml-8 flex-1">
                            <input type="text" placeholder="Search here" 
                                class="w-full max-w-xs px-4 py-2 bg-gray-100 rounded-lg focus:outline-none">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-400 hover:text-gray-500">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 bg-pink-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">5</span>
                        </button>
                        <div class="flex items-center space-x-3">
                            <img src="/api/placeholder/32/32" class="w-8 h-8 rounded-full" alt="Profile">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Brian Lee</p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Filter Section -->
                <div class="flex justify-between mb-8">
                    <p class="text-gray-500">Here is your restaurant summary with graph view</p>
                    <button class="flex items-center space-x-2 bg-pink-50 text-pink-500 px-4 py-2 rounded-lg">
                        <span>Filter Period</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>

                <!-- Most Favorites Items -->
                <div class="bg-white rounded-xl p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold">Most Favorites Items</h2>
                        <div class="flex space-x-4">
                            <button class="text-pink-500 font-medium">All Categories</button>
                            <button class="text-gray-500">Main Course</button>
                            <button class="text-gray-500">Pizza</button>
                            <button class="text-gray-500">Drink</button>
                            <button class="text-gray-500">Dessert</button>
                        </div>
                    </div>

                    <!-- Items Grid -->
                    <div class="grid grid-cols-2 gap-6">
                        @foreach($favoriteItems as $item)
                        <div class="flex items-center space-x-4 p-4 border rounded-xl">
                            <img src="{{ $item->image }}" class="w-24 h-24 rounded-xl object-cover" alt="{{ $item->name }}">
                            <div class="flex-1">
                                <h3 class="font-medium">{{ $item->name }}</h3>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <span>{{ $item->total_sales }} Total Sales</span>
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <span>({{ $item->reviews_count }} reviews)</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 relative">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="16" fill="none" 
                                        class="stroke-current text-gray-200" stroke-width="2"/>
                                    <circle cx="18" cy="18" r="16" fill="none" 
                                        class="stroke-current text-pink-500" stroke-width="2"
                                        stroke-dasharray="{{ $item->percentage * 100 }} 100"
                                        transform="rotate(-90 18 18)"/>
                                </svg>
                                <span class="absolute inset-0 flex items-center justify-center text-sm font-medium">
                                    {{ $item->percentage }}%
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="w-80 bg-white shadow-lg p-6">
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4">Daily Trending Menus</h2>
                <div class="space-y-4">
                    @foreach($trendingMenus as $index => $menu)
                    <div class="flex items-center space-x-4">
                        <span class="font-medium text-gray-500">#{{ $index + 1 }}</span>
                        <div class="flex-1">
                            <h3 class="font-medium">{{ $menu->name }}</h3>
                            <div class="flex items-center space-x-2 text-sm">
                                <span class="text-gray-900">${{ $menu->price }}</span>
                                <span class="text-gray-500">Order {{ $menu->order_percentage }}%</span>
                            </div>
                        </div>
                        <img src="{{ $menu->image }}" class="w-12 h-12 rounded-xl object-cover" alt="{{ $menu->name }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>