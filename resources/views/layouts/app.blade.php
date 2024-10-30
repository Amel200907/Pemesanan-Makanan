<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Restaurant Name') - Restaurant Management System</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            @apply flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200;
        }
        
        .sidebar-link.active {
            @apply bg-blue-50 text-blue-600;
        }
        
        .main-content {
            min-height: calc(100vh - 4rem);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <button type="button" class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" onclick="toggleSidebar()">
                        <span class="sr-only">Open sidebar</span>
                        <i class="fas fa-bars w-6 h-6"></i>
                    </button>
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="/api/placeholder/32/32" alt="Logo">
                        <span class="ml-2 text-xl font-bold text-gray-800">Restaurant</span>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="relative">
                            <input type="text" placeholder="Search..." 
                                class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <button class="ml-4 p-2 text-gray-400 hover:text-gray-500 relative">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-1 right-1 block h-4 w-4 rounded-full bg-red-500 text-white text-xs text-center">3</span>
                    </button>

                    <div class="ml-4 relative">
                        <div class="flex items-center space-x-3">
                            <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="Profile">
                            <div class="hidden md:block">
                                <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'User Name' }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-16 w-64 h-full bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-40" id="sidebar">
        <nav class="mt-5 px-4">
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span>Orders</span>
                </a>
                
                <a href="{{ route('menu.index') }}" class="sidebar-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                    <i class="fas fa-utensils w-5"></i>
                    <span>Menu</span>
                </a>
                
                <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Customers</span>
                </a>
                
                <a href="{{ route('reports.index') }}" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Reports</span>
                </a>
                
                <a href="{{ route('settings.index') }}" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>
            </div>

            <!-- Logout -->
            <div class="mt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 pt-16">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                @yield('breadcrumbs')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $header }}
                    </h1>
                </header>
            @endif

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarButton = document.querySelector('[onclick="toggleSidebar()"]');
            
            if (!sidebar.contains(event.target) && !sidebarButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
