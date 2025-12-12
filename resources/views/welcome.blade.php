<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko KariSya - Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-50 top-0 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="bg-blue-600 p-1.5 rounded-lg group-hover:bg-blue-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800 tracking-tight">KariSya<span class="text-blue-600">Store</span></span>
                    </a>
                </div>

                <div class="flex items-center">
                    @auth
                        <div class="flex items-center gap-6 mr-6">
                            
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-blue-600 font-medium text-xs flex flex-col items-center group transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-0.5 group-hover:scale-110 transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                                    </svg>
                                    Dashboard
                                </a>
                            @endif

                            <a href="{{ route('front.orders') }}" class="text-gray-500 hover:text-blue-600 font-medium text-xs flex flex-col items-center group transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-0.5 group-hover:scale-110 transition">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                Pesanan
                            </a>

                            <div class="hidden sm:flex items-center bg-gray-50 border border-gray-200 rounded-full pr-1 pl-3 py-1 hover:border-blue-300 transition group cursor-default">
                                <div class="flex flex-col items-start mr-3">
                                    <span class="text-[10px] text-gray-400 leading-none">Saldo Saya</span>
                                    <span class="text-sm font-bold text-gray-800 leading-none">
                                        Rp {{ number_format(optional(Auth::user()->balance)->balance, 0, ',', '.') }}
                                    </span>
                                </div>
                                <a href="{{ route('front.topup') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-1 rounded-full shadow-sm transition group-hover:rotate-90" title="Isi Saldo">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="h-8 w-px bg-gray-200 mx-2 hidden md:block"></div>

                        <div class="flex items-center gap-4 ml-6">
                            <div class="flex items-center gap-3 text-right">
                                <div class="hidden md:block">
                                    <div class="text-sm font-bold text-gray-700 leading-tight">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">{{ Auth::user()->role }}</div>
                                </div>
                                <div class="h-9 w-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="group flex items-center justify-center h-9 w-9 rounded-full bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 transition border border-transparent hover:border-red-200" title="Keluar Aplikasi">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full font-medium text-sm hover:bg-blue-700 shadow-md hover:shadow-lg transition">Daftar Sekarang</a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 mt-24 mb-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm relative animate-fade-in-down">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm animate-fade-in-down">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Ups, ada masalah!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-8 flex gap-8 pb-12">

        <aside class="w-1/4 hidden md:block">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    Kategori
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('home') }}" 
                           class="block px-3 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 font-bold border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' }}">
                            Semua Produk
                        </a>
                    </li>

                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('front.category', $category->slug) }}" 
                               class="block px-3 py-2 rounded-lg transition {{ request()->is('category/' . $category->slug) ? 'bg-blue-50 text-blue-700 font-bold border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <main class="w-full md:w-3/4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
                <span class="bg-blue-600 w-2 h-8 rounded-full"></span>
                Produk Terbaru
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <a href="{{ route('front.details', $product->slug) }}" class="block overflow-hidden relative">    
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold text-gray-600 shadow-sm">
                            Stok: {{ $product->stock }}
                        </div>
                    </a>    
                    
                    <div class="p-5">
                        <a href="{{ route('front.details', $product->slug) }}">
                            <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mt-1 truncate">{{ $product->description }}</p>
                        
                        <div class="flex justify-between items-end mt-4 pt-4 border-t border-gray-50">
                            <div>
                                <span class="text-xs text-gray-400 block mb-0.5">Harga</span>
                                <span class="text-blue-600 font-bold text-lg">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('front.details', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-blue-200 shadow-md">
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