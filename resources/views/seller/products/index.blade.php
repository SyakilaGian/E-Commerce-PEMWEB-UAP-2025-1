<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-gray-900">
                {{ __('Daftar Produk') }}
            </h2>
            <div class="text-sm text-gray-600">
                Total: <span class="font-semibold">{{ $products->total() }}</span> produk
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        {{-- Flash message dengan animasi --}}
        <div class="mb-6 space-y-3">
            @if(session('success'))
                <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center p-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-lg shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-800 font-medium">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Header dengan tombol dan pencarian --}}
        <div class="mb-8 bg-white rounded-2xl shadow-lg p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Kelola Produk Anda</h3>
                    <p class="text-gray-600 mt-1">Tambah, edit, atau hapus produk yang dijual di toko Anda</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari produk..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <a href="{{ route('seller.products.create') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Produk
                    </a>
                </div>
            </div>
        </div>

        {{-- Kartu Produk Grid --}}
        <div class="mb-8">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            {{-- Gambar Produk --}}
                            <div class="relative h-48 overflow-hidden bg-gray-50">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                {{-- Badge Stok --}}
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Informasi Produk --}}
                            <div class="p-5">
                                <div class="mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm text-gray-600">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                                        <span class="mx-2 text-gray-300">•</span>
                                        <span class="text-sm text-gray-600">SKU: {{ $product->sku ?? '-' }}</span>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-2xl font-bold text-indigo-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                
                                {{-- Statistik Produk --}}
                                <div class="flex items-center justify-between mb-5 text-sm text-gray-500 border-t border-b border-gray-100 py-3">
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->views ?? 0 }}</div>
                                        <div class="text-xs">Dilihat</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->sold_count ?? 0 }}</div>
                                        <div class="text-xs">Terjual</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->rating ?? '0.0' }}</div>
                                        <div class="text-xs">Rating</div>
                                    </div>
                                </div>
                                
                                {{-- Tombol Aksi --}}
                                <div class="flex space-x-2">
                                    <a href="{{ route('seller.products.edit', $product) }}"
                                       class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-lg hover:from-amber-600 hover:to-amber-700 shadow-sm hover:shadow transition-all duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <button onclick="confirmDelete('{{ $product->id }}', '{{ addslashes($product->name) }}')"
                                            class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-rose-700 shadow-sm hover:shadow transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    {{-- Form Hapus Tersembunyi --}}
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('seller.products.destroy', $product) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- State Kosong --}}
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-full mb-6">
                            <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Produk</h3>
                        <p class="text-gray-600 mb-6">Mulai jualan dengan menambahkan produk pertama Anda</p>
                        <a href="{{ route('seller.products.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Produk Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="bg-white rounded-xl shadow-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $products->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-2xl bg-white">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.791-.833-2.561 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Produk</h3>
                <p class="text-gray-600 mb-6">Anda yakin ingin menghapus produk <span id="productName" class="font-semibold text-gray-900"></span>? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()"
                            class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors duration-300">
                        Batal
                    </button>
                    <button onclick="submitDelete()"
                            class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-lg font-medium hover:from-red-600 hover:to-rose-700 transition-all duration-300 shadow-sm">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let productIdToDelete = null;
        
        function confirmDelete(id, name) {
            productIdToDelete = id;
            document.getElementById('productName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            productIdToDelete = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }
        
        function submitDelete() {
            if (productIdToDelete) {
                document.getElementById('delete-form-' + productIdToDelete).submit();
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target.id === 'deleteModal') {
                closeDeleteModal();
            }
        });
    </script>
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush
</x-app-layout>