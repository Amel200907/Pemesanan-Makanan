<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SantapAja - @yield('title', 'Welcome')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    @auth
        @if(auth()->user()->role === 'admin')
            @include('layouts.admin-nav')
        @else
            @include('layouts.customer-nav')
        @endif
    @endauth

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">SantapAja</h3>
                    <p class="text-gray-400">Restoran terbaik untuk santapan lezat Anda Manjakan Lidah Anda Dengan Kelesatan Makanan Kami Pesan Dan Tunggu Makanan Anda</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <ul class="text-gray-400">
                        <li>Email: santapaja@gmail.com</li>
                        <li>Phone: +62 821 7616 0098</li>
                        <li>Address: Jl Prof.Dr Hamka no.27</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Jam Operasional</h3>
                    <ul class="text-gray-400">
                        <li>Senin - Jumat: 08:00 - 22:00</li>
                        <li>Sabtu - Minggu: 09:00 - 20:00</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SantapAja. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
