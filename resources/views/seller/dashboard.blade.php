{{-- resources/views/seller/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Toko Anda') }}
        </h2>
    </x-slot>
    
    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Dashboard -->
            <div class="mb-8 px-4 sm:px-0">
                <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, Penjual!</h1>
                <p class="text-gray-600 mt-1">Pantau kinerja dan kelola toko Anda dari sini</p>
            </div>

            {{-- Bagian 1: KPI Cards Toko --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                {{-- Card 1: Total Produk --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-blue-50 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-blue-700 bg-blue-50 px-2 py-1 rounded">Aktif</span>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $productCount ?? '0' }}</p>
                </div>

                {{-- Card 2: Penjualan Hari Ini --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-green-50 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-700 bg-green-50 px-2 py-1 rounded">Hari Ini</span>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Penjualan</p>
                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($salesToday ?? 0, 0, ',', '.') }}</p>
                </div>
                
                {{-- Card 3: Total Pesanan Baru --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-amber-50 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-amber-700 bg-amber-50 px-2 py-1 rounded">{{ $pendingOrdersCount ?? '0' }} Baru</span>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pesanan Menunggu</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingOrdersCount ?? '0' }}</p>
                </div>

                {{-- Card 4: Review Baru --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-rose-50 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-rose-700 bg-rose-50 px-2 py-1 rounded">Terbaru</span>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Review Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $newReviewsCount ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>