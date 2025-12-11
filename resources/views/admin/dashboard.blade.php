<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold">Total Produk</h3>
                <p class="text-2xl text-indigo-600">{{ $totalProducts ?? 0 }}</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold">Total Seller</h3>
                <p class="text-2xl text-indigo-600">{{ $totalSellers ?? 0 }}</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold">Total User</h3>
                <p class="text-2xl text-indigo-600">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>

        <!-- Tambahan tombol navigasi -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded p-6 flex flex-col items-center">
                <h3 class="text-lg font-bold mb-4">Verifikasi Toko</h3>
                <a href="{{ route('admin.verification.index') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Lihat Daftar Verifikasi
                </a>
            </div>

            <div class="bg-white shadow rounded p-6 flex flex-col items-center">
                <h3 class="text-lg font-bold mb-4">Manajemen User</h3>
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Kelola User
                </a>
            </div>
        </div>
    </div>
</x-app-layout>