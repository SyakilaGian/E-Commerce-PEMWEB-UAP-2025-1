<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KariSya Store</title>
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
                        <img src="{{ asset('images/logo.png') }}" alt="KariSya Store Logo" class="h-10 w-auto transition transform group-hover:scale-105">
                        <span class="text-xl font-bold text-gray-800 tracking-tight">KariSya<span class="text-blue-600">Store</span></span>
                    </a>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                        Lanjut Belanja
                    </a>

                    <div class="h-6 w-px bg-gray-200"></div>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-lg transition group" title="Edit Profil">
                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ Auth::user()->role }}</div>
                        </div>
                        <div class="h-9 w-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white group-hover:ring-blue-100 transition">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-12">
        <div class="flex flex-col md:flex-row gap-8">
            
            <aside class="w-full md:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-5 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800">Menu Anggota</h3>
                    </div>
                    <nav class="p-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Profil Saya
                        </a>
                        
                        <a href="{{ route('front.orders') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 font-bold rounded-lg border-l-4 border-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            Riwayat Pesanan
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 hover:text-red-700 rounded-lg transition mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                Keluar Aplikasi
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <main class="w-full md:w-3/4">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Pesanan Saya</h1>
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">
                        Total: {{ $transactions->count() }} Transaksi
                    </div>
                </div>

                @if($transactions->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center fade-in">
                        <div class="bg-blue-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada transaksi</h3>
                        <p class="text-gray-500 mb-8 max-w-sm mx-auto">Kamu belum pernah belanja nih. Yuk cari barang bagus di toko kami!</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-lg hover:shadow-xl transition">
                            Mulai Belanja Sekarang
                        </a>
                    </div>
                @else
                    <div class="space-y-6 fade-in">
                        @foreach($transactions as $trx)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                                
                                <div class="bg-gray-50 px-6 py-4 flex flex-wrap justify-between items-center border-b border-gray-100 gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-white p-2 rounded border border-gray-200">
                                            <span class="font-mono font-bold text-gray-600 text-xs">#{{ $trx->code }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                            {{ $trx->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div>
                                        @if($trx->payment_status == 'paid')
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                                LUNAS
                                            </span>
                                        @elseif($trx->payment_status == 'unpaid')
                                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">
                                                BELUM BAYAR
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">
                                                BATAL
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="space-y-4">
                                        @foreach($trx->details as $detail)
                                            <div class="flex items-start gap-4">
                                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                    <img src="{{ asset('storage/' . $detail->product->image) }}" 
                                                         alt="{{ $detail->product->name }}" 
                                                         class="h-full w-full object-cover object-center">
                                                </div>
                                                
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-800 text-sm md:text-base">{{ $detail->product->name }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">Jumlah: {{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                                </div>

                                                <div class="font-bold text-gray-800 text-sm md:text-base">
                                                    Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                                    <div class="text-xs text-gray-500">
                                        Metode: <span class="uppercase font-bold text-gray-700">{{ $trx->payment_method }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Total Bayar:</span>
                                        <span class="text-lg font-bold text-blue-600">
                                            Rp {{ number_format($trx->grand_total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </main>

        </div>
    </div>

</body>
</html>