<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Member') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p>Selamat datang, {{ auth()->user()->name }}! Anda login sebagai <strong>Member</strong>.</p>

                <p class="mt-4">
                    Silakan daftar toko melalui menu <strong>Daftar Toko</strong> di navigasi.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>