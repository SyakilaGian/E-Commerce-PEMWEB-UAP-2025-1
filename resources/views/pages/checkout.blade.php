<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - KariSya Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-7xl mx-auto">
            <a href="/" class="flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                &larr; Batal & Kembali Belanja
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 mb-20">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout Pengiriman</h1>

        <form action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Alamat Pengiriman</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                            <input type="text" name="city" required class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Malang">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" name="postal_code" required class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="65141">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Nama Jalan, No Rumah, RT/RW, Patokan"></textarea>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Jasa Pengiriman</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="shipping_method" value="jne" checked class="h-4 w-4 text-blue-600">
                            <div class="ml-4 flex-1">
                                <span class="block font-medium text-gray-900">JNE Reguler</span>
                                <span class="block text-sm text-gray-500">Estimasi tiba: 2-3 Hari</span>
                            </div>
                            <span class="font-bold text-gray-900">Rp 22.000</span>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="shipping_method" value="sicepat" class="h-4 w-4 text-blue-600">
                            <div class="ml-4 flex-1">
                                <span class="block font-medium text-gray-900">SiCepat</span>
                                <span class="block text-sm text-gray-500">Estimasi tiba: 3-5 Hari</span>
                            </div>
                            <span class="font-bold text-gray-900">Rp 15.000</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                            <input type="radio" name="payment_method" value="wallet" class="h-4 w-4 text-blue-600">
                            <div class="ml-4 flex-1">
                                <span class="block font-bold text-gray-900">My Wallet</span>
                                <span class="block text-sm text-gray-500">Saldo: Rp {{ number_format(Auth::user()->balance->balance ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                            <input type="radio" name="payment_method" value="va_transfer" class="h-4 w-4 text-blue-600">
                            <div class="ml-4 flex-1">
                                <span class="block font-bold text-gray-900">Transfer Virtual Account</span>
                                <span class="block text-sm text-gray-500">Bank BNI, BRI, Mandiri, BCA</span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm sticky top-24">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Ringkasan Pesanan</h2>
                    
                    <div class="flex gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover rounded-md">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $qty }} x Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-6 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan</span>
                            <span>Rp 2.000</span>
                        </div>
                        <div class="flex justify-between font-medium text-black">
                            <span>Ongkos Kirim (Estimasi)</span>
                            <span>Rp 22.000</span>
                        </div>
                    </div>

                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between items-center font-bold text-lg text-blue-600">
                            <span>Total Tagihan</span>
                            <span>Rp {{ number_format($subtotal + 22000 + 2000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="{{ $qty }}">
                    <input type="hidden" name="total_price" value="{{ $subtotal + 22000 + 2000 }}">

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                        Bayar Sekarang
                    </button>
                    
                    <p class="text-xs text-center text-gray-400 mt-4">
                        Keamanan pembayaran terjamin oleh KariSya Secure Payment.
                    </p>
                </div>
            </div>
        </form>
    </div>

</body>
</html>