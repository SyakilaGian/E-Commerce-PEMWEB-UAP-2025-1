<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - KariSya Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-7xl mx-auto">
            <a href="/" class="flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                &larr; Kembali ke Home
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
        
        <div class="bg-white p-4 rounded-xl shadow-sm">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-auto rounded-lg object-cover border">
        </div>

        <div class="space-y-6">
            
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-bold uppercase">
                        {{ $product->productCategory->name }}
                    </span>
                    <span class="text-gray-500 text-sm">Stok: {{ $product->stock }}</span>
                    <span class="text-gray-500 text-sm border-l pl-2 ml-2">{{ ucfirst($product->condition) }}</span>
                </div>
                <div class="text-4xl font-bold text-red-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-xl">
                    🏪
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">{{ $product->store->name }}</h3>
                    <p class="text-sm text-green-600">Verified Seller ✅</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-bold text-lg mb-3">Deskripsi Produk</h3>
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $product->description }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
                <form action="{{ route('checkout') }}" method="GET"> 
                    <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                    
                    <div class="flex items-center gap-4 mb-4">
                        <label class="font-semibold">Jumlah:</label>
                        <select name="quantity" class="border rounded p-2 w-20">
                            @for($i = 1; $i <= min($product->stock, 10); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    @auth
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                            Beli Sekarang 🛒
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="block text-center w-full bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-gray-900">
                            Login untuk Membeli
                        </a>
                    @endauth
                </form>
            </div>

        </div>
    </div>

</body>
</html>