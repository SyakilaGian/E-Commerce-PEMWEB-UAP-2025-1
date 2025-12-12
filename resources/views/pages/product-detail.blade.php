<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - KariSya Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo.png') }}" alt="KariSya Logo" class="h-10 w-auto transition transform group-hover:scale-105">
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-12 fade-in">
        
        <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('front.category', $product->productCategory->slug) }}" class="ml-1 hover:text-blue-600">{{ $product->productCategory->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-gray-700 font-medium truncate max-w-[200px]">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                
                <div class="p-8 bg-gray-50 flex items-center justify-center border-r border-gray-100">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full max-w-md h-auto rounded-xl shadow-lg object-cover hover:scale-105 transition duration-500">
                </div>

                <div class="p-8 md:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-700 text-xs px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wide">
                                {{ $product->productCategory->name }}
                            </span>
                            @if($product->stock > 0)
                                <span class="bg-green-100 text-green-700 text-xs px-2.5 py-0.5 rounded-full font-bold">Stok Tersedia</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-xs px-2.5 py-0.5 rounded-full font-bold">Habis</span>
                            @endif
                        </div>

                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2 leading-tight">{{ $product->name }}</h1>
                        
                        <div class="text-4xl font-bold text-blue-600 mb-6">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <div class="flex items-center justify-between border-t border-b border-gray-100 py-4 mb-6">
                            <a href="{{ route('front.store', $product->store->slug) }}" class="flex items-center gap-4 group">
                                <div class="h-12 w-12 bg-gradient-to-tr from-blue-600 to-blue-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm group-hover:ring-2 ring-blue-200 transition">
                                    {{ substr($product->store->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition">
                                        {{ $product->store->name }}
                                        @if($product->store->is_verified)
                                            <span class="inline-block ml-1 text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                  <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </h3>
                                    <p class="text-xs text-gray-500">Online</p>
                                </div>
                            </a>
                            <a href="{{ route('front.store', $product->store->slug) }}" class="text-sm font-medium text-blue-600 hover:underline">
                                Kunjungi Toko
                            </a>
                        </div>

                        <div class="mb-8">
                            <h3 class="font-bold text-gray-900 mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                        </div>
                    </div>

                    <form action="{{ route('checkout') }}" method="GET" class="space-y-4">
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                        
                        <div class="flex items-center gap-4">
                            <div class="w-32">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jumlah</label>
                                <div class="relative">
                                    <select name="quantity" class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-700 py-2.5 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                                        @for($i = 1; $i <= min($product->stock, 10); $i++)
                                            <option value="{{ $i }}">{{ $i }} Pcs</option>
                                        @endfor
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <label class="block text-xs font-bold text-transparent uppercase mb-1">.</label>
                                @auth
                                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                                        <span>Beli Sekarang</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="block text-center w-full bg-gray-800 text-white font-bold py-2.5 rounded-lg hover:bg-gray-900 transition shadow-lg">
                                        Login untuk Membeli
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="mt-12">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Produk Lainnya</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($recommendations as $rec)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                        <a href="{{ route('front.details', $rec->slug) }}">
                            <img src="{{ asset('storage/' . $rec->image) }}" class="w-full h-32 object-cover group-hover:opacity-90 transition">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 text-sm truncate">{{ $rec->name }}</h4>
                                <div class="text-blue-600 font-bold text-sm mt-1">
                                    Rp {{ number_format($rec->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</body>
</html>