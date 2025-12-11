<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $store->name }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        {{-- Logo & Deskripsi --}}
        <div class="mb-6 flex items-center space-x-4">
            @if($store->logo)
                <img src="{{ asset('storage/'.$store->logo) }}" alt="Logo Toko" class="w-20 h-20 object-cover rounded">
            @endif
            <div>
                <p class="text-lg font-bold">{{ $store->name }}</p>
                <p class="text-gray-600">{{ $store->description }}</p>
            </div>
        </div>

        {{-- Daftar Produk --}}
        <h3 class="text-lg font-semibold mb-4">Produk Toko</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white shadow rounded p-4">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-2">
                    @endif
                    <h4 class="font-bold">{{ $product->name }}</h4>
                    <p class="text-gray-600">Rp {{ number_format($product->price) }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada produk.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>