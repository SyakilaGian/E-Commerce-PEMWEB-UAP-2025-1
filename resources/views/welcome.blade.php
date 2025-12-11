<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko KariSya - Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-lg fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-blue-600">KariSya-Store</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                                Admin Dashboard
                            </a>
                        @endif

                        <div class="flex items-center gap-2">
                            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                Rp {{ number_format(optional(Auth::user()->balance)->balance, 0, ',', '.') }}
                            </div>

                            <a href="{{ route('front.topup') }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-xs font-bold transition shadow-sm">
                                + Isi Saldo
                            </a>
                        </div>

                        <span class="text-gray-700">Hi, {{ Auth::user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 mt-24 flex gap-6">

        <aside class="w-1/4 hidden md:block">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Kategori</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" 
                           class="{{ request()->routeIs('home') ? 'text-blue-600 font-bold' : 'text-gray-600 font-medium hover:underline hover:text-blue-500' }}">
                            Semua Produk
                        </a>
                    </li>

                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('front.category', $category->slug) }}" 
                                class="{{ request()->is('category/' . $category->slug) ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-500 hover:underline' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <main class="w-full md:w-3/4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Produk Terbaru</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-xl transition duration-300 overflow-hidden">
                <a href="{{ route('front.details', $product->slug) }}">    
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover hover:opacity-90 transition">
                </a>    
                    <div class="p-4">
                        <a href="{{ route('front.details', $product->slug) }}">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mt-1 truncate">{{ $product->description }}</p>
                        
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-blue-600 font-bold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('front.details', $product->slug) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </main>
    </div>

</body>
</html>