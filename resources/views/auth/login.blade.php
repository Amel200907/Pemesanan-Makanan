<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-gradient-to-br {
            from: #eead8a;
            to: #c7996e;
        }
        .text-gray-800 {
            color: #422e1a;
        }
        .isometric-illustration {
            transform: rotateX(10deg) rotateY(-20deg);
            transform-style: preserve-3d;
        }
        .building {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-6">
    <div class="container max-w-screen-lg mx-auto">
        <div class="bg-white rounded-2xl shadow-xl flex flex-col md:flex-row">
            <!-- Left Side - Illustration -->
            <div class="w-full md:w-1/2 p-12 flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600 rounded-l-2xl">
                <div class="isometric-illustration building">
                    <svg class="w-full max-w-md" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Building 1 -->
                        <rect x="50" y="100" width="60" height="150" fill="#60A5FA" />
                        <rect x="65" y="120" width="30" height="30" fill="#DBEAFE" />
                        <rect x="65" y="160" width="30" height="30" fill="#DBEAFE" />
                        <rect x="65" y="200" width="30" height="30" fill="#DBEAFE" />
                        
                        <!-- Building 2 -->
                        <rect x="170" y="50" width="60" height="200" fill="#3B82F6" />
                        <rect x="185" y="70" width="30" height="30" fill="#DBEAFE" />
                        <rect x="185" y="110" width="30" height="30" fill="#DBEAFE" />
                        <rect x="185" y="150" width="30" height="30" fill="#DBEAFE" />
                        <rect x="185" y="190" width="30" height="30" fill="#DBEAFE" />
                        
                        <!-- Building 3 -->
                        <rect x="290" y="150" width="60" height="100" fill="#2563EB" />
                        <rect x="305" y="170" width="30" height="30" fill="#DBEAFE" />
                        <rect x="305" y="210" width="30" height="30" fill="#DBEAFE" />
                    </svg>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="w-full md:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome to Santap Aja</h2>
                        <p class="text-gray-500">Please sign in to your account</p>
                    </div>

                    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input id="email" type="email" name="email" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input id="password" type="password" name="password" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                                required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" 
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                            Sign In
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <p class="text-center mt-8 text-sm text-gray-600">
                            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Register</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
