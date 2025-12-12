<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} - KariSya Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo-ks.png') }}" alt="KariSya Logo" class="h-10 w-auto transition transform group-hover:scale-105">
                        <span class="text-xl font-bold text-gray-800 tracking-tight">KariSya<span class="text-blue-600">Store</span></span>
                    </a>
                </div>

                <div class="flex items-center">
                    @auth
                        <div class="flex items-center gap-6 mr-6">
                            <a href="{{ route('front.orders') }}" class="text-gray-500 hover:text-blue-600 font-medium text-xs flex flex-col items-center group transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-0.5 group-hover:scale-110 transition">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                Pesanan
                            </a>
                            
                            <div class="hidden sm:flex items-center bg-gray-50 border border-gray-200 rounded-full pr-1 pl-3 py-1 hover:border-blue-300 transition cursor-default">
                                <div class="flex flex-col items-start mr-3">
                                    <span class="text-[10px] text-gray-400 leading-none">Saldo</span>
                                    <span class="text-sm font-bold text-gray-800 leading-none">
                                        Rp {{ number_format(optional(Auth::user()->balance)->balance, 0, ',', '.') }}
                                    </span>
                                </div>
                                <a href="{{ route('front.topup') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-1 rounded-full shadow-sm transition" title="Isi Saldo">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="h-8 w-px bg-gray-200 mx-2 hidden md:block"></div>

                        <div class="flex items-center gap-4 ml-6">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-lg transition group">
                                <div class="text-right hidden sm:block">
                                    <div class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ Auth::user()->role }}</div>
                                </div>
                                <div class="h-9 w-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white group-hover:ring-blue-100 transition">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </a>
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

    <div class="bg-white border-b border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                
                <div class="h-24 w-24 bg-gradient-to-tr from-blue-600 to-cyan-500 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg ring-4 ring-blue-50">
                    {{ substr($store->name, 0, 1) }}
                </div>

                <div class="text-center md:text-left flex-1">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $store->name }}</h1>
                        @if($store->is_verified)
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-bold flex items-center gap-1 border border-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                  <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                                Official Store
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-500 max-w-2xl mb-4">{{ $store->about ?? 'Toko ini menyediakan berbagai macam produk berkualitas.' }}</p>
                    
                    <div class="flex items-center justify-center md:justify-start gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            <span class="font-bold text-gray-900">{{ $products->count() }}</span> Produk
                        </div>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Bergabung {{ $store->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <span class="bg-blue-600 w-1.5 h-6 rounded-full"></span>
            Etalase Produk
        </h2>

        @if($products->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500">Toko ini belum memiliki produk.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 overflow-hidden group">
                    <a href="{{ route('front.details', $product->slug) }}" class="block overflow-hidden relative">    
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold text-gray-600 shadow-sm">
                            Stok: {{ $product->stock }}
                        </div>
                    </a>    
                    
                    <div class="p-4">
                        <a href="{{ route('front.details', $product->slug) }}">
                            <h3 class="text-base font-bold text-gray-800 truncate group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-xs mt-1 truncate">{{ $product->description }}</p>
                        
                        <div class="flex justify-between items-end mt-3 pt-3 border-t border-gray-50">
                            <div>
                                <span class="text-xs text-gray-400 block mb-0.5">Harga</span>
                                <span class="text-blue-600 font-bold text-base">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('front.details', $product->slug) }}" class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                                Beli
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>